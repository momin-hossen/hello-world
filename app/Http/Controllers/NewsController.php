<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    use HasUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::when(request('search'), function($q) {
            $q->where('title', 'like', '%'.request('search').'%');
        })
        ->latest()
        ->paginate(2);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'is_breaking' => 'required|integer',
            'status' => 'required|integer',
        ]);

        News::create($request->except('image') + [
            'image' => $this->upload($request, 'image')
        ]);

        // return response()->json([
        //     'message' => 'News created successfully.',
        //     'redirect' => route('admin.news.index')
        // ]);
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'is_breaking' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $news = News::findOrFail($id);

        $news->update($request->except('image') + [
            'image' => $request->hasFile('image') ? $this->upload($request, 'image', $news->image) : $news->image
        ]);

        return response()->json([
            'message' => 'News updated successfully.',
            'redirect' => route('admin.news.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);
        if (file_exists($news->image ?? false)) {
            Storage::delete($news->image);
        }
        $news->delete();
        return response()->json([
            'message' => 'News deleted successfully.',
            'redirect' => route('admin.news.index')
        ]);
    }
}
