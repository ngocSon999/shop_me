@extends('frontend.layouts.master')
@section('title', 'Quên mật khẩu')
@section('style')
    <style>
        #password {
            position: relative;
        }
        #show-password {
            position: absolute;
            bottom: 14px;
            right: 10px;
            font-size: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-2">
            <div class="row g-5 align-items-center">
                <div class="col-md-6 col-12">
                    <form action="{{ route('web.post_reset_password') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label class="d-flex" for="">Password<p class="ms-2 text-danger">*</p></label>
                            <input class="form-control" name="password" type="text">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="d-flex" for="">Password confirmation<p class="ms-2 text-danger">*</p></label>
                            <input class="form-control" name="password_confirmation" type="text">
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message  }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
