@extends('frontend.layouts.master')
@section('title', 'Đăng nhập')
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
    <div class="col-12 col-md-6">
        <form action="{{ route('web.login.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="d-flex" for="">Email<p class="ms-2 text-danger">*</p></label>
                <input class="form-control" name="email" type="text">
            </div>
            <div id="password" class="form-group">
                <label class="d-flex" for="">Mật khẩu<p class="ms-2 text-danger">*</p></label>
                <input class="form-control" name="password" type="password" id="password-input">
                <i id="show-password" class="fas fa-eye"></i>
            </div>
            <button type="submit" class="btn btn-primary btn-sm mt-4">Đăng nhập</button>
        </form>
    </div>
    <div class="d-none d-md-block col-6">
        <div class="text-center">Làm đẹp</div>
    </div>
@endsection
@section('js')
    <script>
        $('#show-password').on('click', function () {
            if ($('#password-input').attr('type') === 'password') {
                $('#password-input').attr('type', 'text');
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
            } else {
                $('#password-input').attr('type', 'password');
                $(this).addClass('fa-eye');
                $(this).removeClass('fa-eye-slash');
            }
        })
    </script>
@endsection
