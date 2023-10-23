@extends('layouts.admin.app', [
    'title' => 'Add News',
    'buttons' => [['name' => 'View List', 'link' => route('admin.news.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('admin.news.update', $news->id) }}" method="post" class="custom-reload-form" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">@lang('Update News')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" class="form-control" name="title" value="{{ $news->title }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="is_breaking" class="form-label">Is Breaking</label>
                            <select name="is_breaking" id="is_breaking" class="form-control">
                                <option @selected($news->is_breaking == '1') value="1">@lang('true')</option>
                                <option @selected($news->is_breaking == '0') value="0">@lang('false')</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="status" class="form-label">status</label>
                            <select name="status" id="status" class="form-control">
                                <option @selected($news->status == '1') value="1">@lang('Active')</option>
                                <option @selected($news->status == '0') value="0">@lang('Deactive')</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $news->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <div class="preview-seo_image">
                                <label for="image" class="form-label text-start d-block">@lang('Image')</label>
                                <label for="image" class="image-preview">
                                    <img width="60px" height="60px" class="mt-3" src="{{ asset($news->image ?? 'assets/img/icons/no-image.png') }}" alt="">
                                    <p>Please select an image.</p>
                                </label>
                                <input class="form-control d-none image-input" type="file" id="image" name="image">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="reset" class="btn btn-outline-danger mx-1"><i class='bx bx-reset'></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary ajax-btn mx-1"><i class='bx bx-save'></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
