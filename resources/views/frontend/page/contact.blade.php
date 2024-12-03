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

        .btn-primary {
            background-color: #007bff;
            border: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid contact-page" style="margin-top: 108px">
        <div class="container py-3">
            <h2 class="text-center mb-4">Liên Hệ</h2>
            <div class="row justify-content-center">
                <div class="contact-form">
                    <form action="{{ route('web.contact.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ và tên:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Chủ đề:</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Nhập chủ đề" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Nội dung:</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required placeholder="Nhập nội dung"></textarea>
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
