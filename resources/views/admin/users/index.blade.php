@extends('layouts.admin.app')

@section('contents')
<div class="container">
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2 totals">
                                    <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                </h3>
                            </div>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class='bx bx-grid-small bx-sm'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Active Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">
                                    <h3 class="mb-0 me-2 active_total">
                                        <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                    </h3>
                                </h3>
                            </div>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                            <i class='bx bx-check-square bx-sm'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Deactive Users</span>
                            <div class="d-flex align-items-end mt-2">
                                <h3 class="mb-0 me-2">
                                    <h3 class="mb-0 me-2 deactive_total">
                                        <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                    </h3>
                                </h3>
                            </div>
                        </div>
                        <span class="badge bg-label-danger rounded p-2">
                            <i class='bx bx-x bx-sm'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-end">
                            <a class="btn btn-primary btn-sm mb-2" href="{{ route('admin.users.create') }}">Add User</a>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-sm-6">
                            <h5>Users List</h5>
                        </div>

                        <div class="col-md-4 text-end">
                            <form action="" method="get">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..." aria-describedby="button-addon2" value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit" id="button-addon2"><i class='bx bx-search-alt-2'></i></button>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>SL.</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Avatar') }}</th>
                                <th>{{ __('E-mail') }}</th>
                                <th>{{ __('Username') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $user)
                                <tr>
                                    @can('users-delete')
                                    <th class="pe-0">
                                        <div class="form-check mb-0 mt-1">
                                            <input class="form-check-input checkbox-item" type="checkbox" name="ids[]" value="{{ $user->id }}" id="multi-select-td">
                                            <label class="form-check-label" for="multi-select-td"></label>
                                        </div>
                                    </th>
                                    @endcan
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td><img width="35" height="35" class="rounded-circle" src="{{ asset($user->avatar ?? 'assets/img/avatars/default-user.jpg') }}"></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td><span class="badge rounded-pill bg-label-{{ $user->status ? 'primary':'danger' }}">{{ $user->status ? 'Active':'Deactive' }}</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    {{ __('Edit') }}
                                                </a>
                                                <a class="dropdown-item delete-confirm" data-method="DELETE" href="{{ route('admin.users.destroy', $user->id) }}">
                                                    <i class="bx bx-trash me-1"></i>
                                                    {{ __('Delete') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="row mx-2 mt-2">
                    <div class="col-sm-12">
                        {{ $users->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
