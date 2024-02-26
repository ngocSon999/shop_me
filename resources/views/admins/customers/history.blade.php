@extends('admins.layouts.master')
@section('title', 'Customer')
@section("style")
    <style>

    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lịch sử giao dịch xu</h1>
                    <p>Khách hàng: {{ $customer->email }}</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Customer</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <strong>Chi tiết giao dịch:</strong>
                            @foreach($histories as $key => $history)
                                <div class="d-flex mb-2 mt-2">
                                    <span><strong>{{ $key + 1 }}. Số xu hiện tại:</strong> {{ $history->total_coin ? number_format($history->total_coin, 0, ',', '.') : '' }}</span>
                                    <span class="ml-2"><strong>Số xu giao dịch:</strong>
                                        {{ $history->coin_spent > 0 ?
                                        '+'.number_format($history->coin_spent, 0, ',', '.') :
                                         '-'.number_format($history->coin_spent, 0, ',', '.') }}
                                    </span>
                                    <span class="ml-2"><strong>Nội dung thay đổi xu:</strong> {{ $history->note }}</span>
                                    <span class="ml-2"><strong>Thời gian:</strong> {{ (new DateTime($history->created_at))->format('d/m/Y H:i:s') }}</span>
                                </div>
                            @endforeach

                            <div class="row mt-3">
                                <div class="col-md-4 col-12 mb-2">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <a href="{{ route('admin.customers.transaction_history', ['id' => $customer->id]) }}">Quay lại trang quản lý khách hàng</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $('#show-form-change-password').on('click', function (e) {
            e.preventDefault();
            $('.change-password-customer').toggleClass('active');
        })

        $('#btn-change-password').on('click', function () {
            let password = $('input[name=password]').val().trim();
            let password_confirmation = $('input[name=password_confirmation]').val().trim();
            let customer_id = $('#customer_id').val();

            if (password === '') {
                alert('Mật khẩu không được để trống');
            } else if (password.length < 6 || password.length > 32) {
                alert('Mật khẩu có ít nhất từ 6 đến 32 ký tự');
            } else if (password_confirmation === '' ) {
                alert('Xác nhận mật khẩu không được để trống');
            } else if (password_confirmation !== password) {
                alert('Xác nhận lại mật khẩu không đúng');
            } else {
                if (confirm('Bạn chắc chắn muốn cập nhật nội dung này?')) {
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('admin.customers.change_password') }}',
                        data: {
                            customer_id: customer_id,
                            password: password,
                            password_confirmation: password_confirmation,
                        },
                        success: function (res) {
                            if (res.code === 200) {
                                alert(res.message);
                                $('input[name=password]').val('');
                                $('input[name=password_confirmation]').val('');
                                $('.change-password-customer').removeClass('active');
                            } else {
                                alert(res.message)
                            }
                        },
                        error: function (err) {
                            alert(err.responseJSON.message)
                            console.log('message', err.responseJSON.message)
                        },
                    })
                }
            }
        })
    </script>
@endsection

