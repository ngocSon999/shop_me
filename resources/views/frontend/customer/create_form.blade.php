@php use function Laravel\Prompts\error; @endphp
@extends('frontend.layouts.master')
@section('title', 'Đăng ký tài khoản')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-2">
            <div class="row g-5 align-items-center justify-content-center">
                <div class="col-12 col-md-6">
                    <form action="{{ route('web.customers.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="d-flex" for="">User name<span class="ms-2 text-danger">*</span></label>
                            <input class="form-control" name="name" type="text" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="">Email<span class="ms-2 text-danger">*</span></label>
                            <input class="form-control" name="email" type="text" value="{{ old('email') }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="">Số điện thoại<span class="ms-2 text-danger">*</span></label>
                            <input class="form-control" name="phone" type="text" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Avatar</label>
                            <input class="form-control" name="avatar" type="file">
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="">Mật khẩu<span class="ms-2 text-danger">*</span></label>
                            <input class="form-control" name="password" type="password">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="">Nhập lại mật khẩu<span
                                    class="ms-2 text-danger">*</span></label>
                            <input class="form-control" name="password_confirmation" type="password">
                            @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
