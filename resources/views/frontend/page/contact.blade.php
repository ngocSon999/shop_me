@extends('frontend.layouts.master')

@section('style')
    <style>
        .contact-form {
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid contact-page" style="margin-top: 108px">
        <div class="container py-3">
            <h2 class="text-center">Liên Hệ</h2><br>
            <p class="text-center mb-4">Khách hàng điền thông tin vào Form, chúng tôi sẽ liên hệ lại sớm nhất</p>
            <div class="row justify-content-center">
                <div class="contact-form">
                    <form action="{{ route('web.contact.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" required name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên">
                            @error('name')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nhập SDT">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Tiêu đề<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Nhập chủ đề" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Nội dung<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" value="{{ old('message') }}" name="message" rows="5" required placeholder="Nhập nội dung"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
