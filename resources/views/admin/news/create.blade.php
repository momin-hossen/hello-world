@extends('layouts.admin.app', [
    'title' => 'Add News',
    'buttons' => [['name' => 'View List', 'link' => route('admin.news.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('admin.news.store') }}" method="post" class="custom-reload-form">
    @csrf

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">@lang('Create News')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" class="form-control" name="title" placeholder="Enter news title" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="is_breaking" class="form-label">Is Breaking</label>
                            <select name="is_breaking" id="is_breaking" class="form-control">
                                <option value="1">@lang('true')</option>
                                <option value="0">@lang('false')</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">@lang('Active')</option>
                                <option value="0">@lang('Deactive')</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" placeholder="Enter Description" class="form-control"></textarea>
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
                                    <img width="60px" height="60px" class="mt-3" src="{{ asset('assets/img/icons/no-image.png') }}" alt="">
                                    <p>{{ __('Please select an image.') }}</p>
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
