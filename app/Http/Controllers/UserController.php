<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\HasUploader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use HasUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereRole('user')
                    ->when(request('search'), function($q) {
                        $q->where('name', 'like', '%'.request('search').'%')
                        ->orWhere('email', 'like', '%'.request('search').'%')
                        ->orWhere('phone', 'like', '%'.request('search').'%')
                        ->orWhere('username', 'like', '%'.request('search').'%');
                    })
                    ->latest()
                    ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:0,1',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|unique:users|max:20',
            'password' => 'required|string|min:4|max:15',
            'username' => 'required|string|max:255|unique:users',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500',
        ]);

        User::create($request->except('avatar', 'passowrd') + [
            'password' => bcrypt($request->password),
            'avatar' => $request->avatar ? $this->upload($request, 'avatar') : null
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:0,1',
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:4|max:20',
            'phone' => 'nullable|unique:users,phone,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:500',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
        ]);

        $user->update($request->except('avatar', 'passowrd') + [
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'avatar' => $request->avatar ? $this->upload($request, 'avatar', $user->avatar) : $user->avatar
        ]);

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        // if (file_exists($user->avatar)) {
        //     Storage::delete($user->avatar);
        // }
        // $user->delete();

        $user = User::findOrFail($id);
        if (file_exists($user->avatar ?? false)) {
            Storage::delete($user->avatar);
        }
        $user->delete();

        return back();
    }
}
