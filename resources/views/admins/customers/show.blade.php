@extends('admins.layouts.master')
@section('title', 'Customer')
@section("style")
    <style>
        table tbody a {
            color: black;
        }
        table tbody a:hover {
            color: deepskyblue;
        }
        .change-password-customer {
            display: none;
        }
        .change-password-customer.active {
            display: block;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin chi tiết</h1>
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
                            <h1>CHI TIẾT KHÁCH HÀNG</h1>
                            <p><strong>Name:</strong><span class="ml-2">{{ $customer->name }}</span></p>
                            <p><strong>Email:</strong><span class="ml-2">{{ $customer->email }}</span></p>
                            <p><strong>Phone:</strong><span class="ml-2">{{ $customer->phone }}</span></p>
                            <p><strong>Giới tính:</strong>
                                <span class="ml-2">
                                    @if($customer->gender === 0)
                                        Nam
                                    @elseif($customer->gender === 1)
                                        Nữ
                                    @endif
                                </span></p>
                            <p><strong>Địa chỉ:</strong><span class="ml-2">{{ $customer->address }}</span></p>
                            <div class="row">
                                <div class="col-md-4 col-12 mb-2">
                                    <i class="far fa-edit"></i>
                                    <a href="#" id="show-form-change-password">Cập nhật mật khẩu</a>
                                    <div class="change-password-customer col-12">
                                        <form action="">
                                            <input type="hidden" id="customer_id" value="{{ $customer->id }}">
                                            <div class="form-group">
                                                <label for="">Nhập mật khẩu mới</label>
                                                <input class="form-control" type="text" name="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Xác nhận mật khẩu mới</label>
                                                <input class="form-control" type="text" name="password_confirmation">
                                            </div>
                                            <button class="btn btn-sm btn-success" type="button" id="btn-change-password">Save</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12 mb-2">
                                    <i class="fas fa-history"></i>
                                    <a href="{{ route('admin.customers.transaction_history', ['id' => $customer->id]) }}">Lịch sử giao dịch</a>
                                </div>
                                <div class="col-md-4 col-12 mb-2">
                                    <i class="fas fa-plus"></i>
                                    <a href="{{ route('admin.customers.edit_coin', ['id' => $customer->id]) }}">Nạp tiền</a>
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

