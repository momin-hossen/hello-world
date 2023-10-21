@extends('layouts.admin.app')

@section('contents')
<form action="{{ route('admin.users.update', $user->id) }}" method="post" class="custom-reload-form">
    @csrf
    @method('put')

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">@lang('Create new user')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}" placeholder="Name" autofocus="">
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control" type="text" id="username" name="username" value="{{ $user->username }}" placeholder="Username">
                        </div>
                        <div class="mb-2 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{ $user->email }}" placeholder="john.doe@example.com">
                        </div>
                        <div class="mb-2 col-md-6">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="202 555 0111">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="title" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control status">
                                <option @selected($user->status == 1) value="1">@lang('Active')</option>
                                <option @selected($user->status == 0) value="0">@lang('Deactive')</option>
                            </select>
                        </div>
                        <div class="mb-2 col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="****">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center mb-2">
                            <div class="preview-image">{{-- preview-input_name && Don't add any class without this. --}}
                                <label for="image" class="form-label text-start d-block">@lang('Image')</label>
                                <label for="image" class="image-preview">
                                    <img width="60px" height="60px" class="mt-3" src="{{ asset($user->avatar ?? 'assets/img/icons/no-image.png') }}" alt="">
                                    <p>Please select an image.</p>
                                </label>
                                <input class="form-control d-none image-input" type="file" id="image" name="avatar" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="reset" class="btn btn-outline-danger mx-1 mt-3"><i class='bx bx-reset'></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary ajax-btn mx-1 mt-3"><i class='bx bx-save'></i>
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
