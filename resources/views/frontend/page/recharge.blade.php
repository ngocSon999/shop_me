@extends('frontend.layouts.master')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="container-fluid vesitable" style="margin-top: 108px">
        <div class="container py-3">
            <h1>{{ $rechargeName }}</h1>
            <div class="row">
                <h4>Thông tin tài khoản ngân hàng:</h4>
                <p>VCB Bank (Hoạt động)</p>
                <p>Chủ tài khoản: Nguyễn Văn A</p>
                <p>Số TK: 123456789</p>
                <p>Chuyển khoản ghi đúng nội dung chuyển khoản của bạn ở bên . Tiền sẽ được cộng vào tài khoản Web của bạn sau 15s - 30s</p>
                <p>Hotline Zalo hỗ trợ nếu nạp tiền quá chậm: 0989999999</p>
                <strong>Nội dung chuyển khoản: {{ $code }}</strong>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
@section('js')

@endsection
