@extends('frontend.layouts.master')
@section('title', 'Đăng ký tài khoản')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-2">
            <div class="row g-5 align-items-center">
                <div class="col-12 col-md-6">
                    <form action="{{ route('web.customers.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="d-flex" for="">Name<p class="ms-2 text-danger">*</p></label>
                            <input class="form-control" name="name" type="text" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="">Email<p class="ms-2 text-danger">*</p></label>
                            <input class="form-control" name="email" type="text" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="">Số điện thoại<p class="ms-2 text-danger">*</p></label>
                            <input class="form-control" name="phone" type="text" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh đại diện</label>
                            <input class="form-control" name="avatar" type="file">
                        </div>
                        <div class="form-group">
                            <label for="">Giới tính</label>
                            <select name="gender" id="" class="form-control">
                                <option value="">Chọn giới tính</option>
                                <option value="0">Nam</option>
                                <option value="1">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input class="form-control" name="address" type="text" value="{{ old('address') }}">
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="">Mật khẩu<p class="ms-2 text-danger">*</p></label>
                            <input class="form-control" name="password" type="password">
                        </div>
                        <a href="{{ route('web.index') }}" class="btn btn-dark btn-sm mt-4">Home</a>
                        <button type="reset" class="btn btn-danger btn-sm mt-4">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm mt-4">Tạo tài khoản</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
