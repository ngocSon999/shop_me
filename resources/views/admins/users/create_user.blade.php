@extends('admins.layouts.master')
@section('style')
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(!empty($user))
                        <h3>Cập nhật tài khoản</h3>
                    @else
                        <h3>Thêm mới tài khoản</h3>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Tài khoản</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                @if(!empty($user))
                    <form id="form-edit" class="mt-4 col-12" action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
                        @method('PUT')
                        @else
                            <form id="form-add" class="mt-4 col-12" action="{{ route('admin.users.create') }}" method="POST">
                                @endif
                                @csrf
                                <div class="mb-3 form-group">
                                    <label for="" class="form-label">Name <span class="color-red">*</span></label>
                                    @if(!empty($user))
                                        <input type="text" maxlength="100" class="form-control" name="first_name"
                                               value="{{ old('first_name') ?? $user->first_name}}">
                                    @else
                                        <input type="text" maxlength="100" class="form-control" name="first_name" value="{{ old('first_name') }}">
                                    @endif
                                    <p class="form-message"></p>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="" class="form-label">Email <span class="color-red">*</span></label>
                                    @if(!empty($user))
                                        <input type="email" maxlength="150" class="form-control" name="email"
                                               value="{{ old('email') ?? $user->email }}">
                                    @else
                                        <input type="email" maxlength="150" class="form-control" name="email" value="{{ old('email') }}">
                                    @endif
                                    <p class="form-message"></p>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="" class="form-label">Phone <span class="color-red">*</span></label>
                                    @if(!empty($user))
                                        <input type="text" maxlength="11" class="form-control" name="phone"
                                               value="{{ old('phone') ?? $user->phone }}">
                                    @else
                                        <input type="text" maxlength="11" class="form-control" name="phone" value="{{ old('phone') }}">
                                    @endif
                                    <p class="form-message"></p>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="exampleInputPassword1" class="form-label">Password
                                        @if(empty($user))
                                            <span class="color-red">*</span>
                                        @endif
                                    </label>
                                    <input type="password" class="form-control" name="password">
                                    <p class="form-message"></p>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="exampleInputPassword1" class="form-label">Chọn quyền <span class="color-red">*</span></label>
                                    <select class="form-control" name="role" id="">
                                        <option value="">Chọn quyền</option>
                                        @if(!empty($user))
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $user->roles[0]->id == $role->id ? 'selected' : '' }}
                                                >{{ $role->name }}</option>
                                            @endforeach
                                        @else
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role') == $role->id ? 'selected' : '' }}
                                                >{{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="form-message"></p>
                                </div>
                                @if(!empty($user))
                                    <button id="submit-edit" type="submit" class="btn btn-success mt-2">Save2</button>
                                @else
                                    <button id="submit-add" type="submit" class="btn btn-success mt-2">Save1</button>
                                @endif
                            </form>
                    @endsection
            </div>
        </div>
    </section>
@section('js')
    <script src="{{ asset('assets/cms/js/cms_account.js') }}"></script>
@endsection
