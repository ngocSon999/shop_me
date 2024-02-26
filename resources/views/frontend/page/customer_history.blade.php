@extends('frontend.layouts.master')
@section('style')
    <style>
        .transaction-history a {
            color: #747d88;
        }
        .transaction-history:hover {
            color: #81c408 !important;
        }
        .transaction-history:hover a {
            color: #81c408 !important;
        }
        .product-history {
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid vesitable" style="margin-top: 108px">
        <div class="container py-3">
            <p><strong>Danh sách tài khoản game đã mua:</strong><span class="ms-2">{{ count($products) }} tài khoản</span></p>
            <div class="row mb-2 mt-3">
                @foreach($products as $key => $product)
                <div class="col-12 col-lg-6 mb-2 pb-1 product-history">
                    <p class="m-0"><strong>{{ $key + 1 }}. Danh mục game:</strong><span class="ms-2">{{ $product->categories[0]->name }}</span></p>
                    <p class="m-0"><strong>Tài khoản:</strong><span class="ms-2">{{ $product->account }}</span></p>
                    <p class="m-0"><strong>Mật khẩu:</strong><span class="ms-2">{{ $product->password }}</span></p>
                    <p class="m-0">
                        <strong>Ngày giao dịch:</strong>
                        <span class="ms-2">
                        {{ $product->updated_at ? (new DateTime($product->updated_at))->format('d/m/Y H:i:s') : '' }}
                    </span>
                    </p>
                </div>
                @endforeach
            </div>
            <div class="row mb-2 pb-1 mt-3">
                <div class="transaction-history">
                    <i class="fas fa-history"></i>
                    <a data-bs-toggle="collapse" href="#collapseExample" title="Lịch sử giao dịch xu">
                        Lịch sử giao dịch xu
                    </a>
                </div>
                <div class="collapse p-0" id="collapseExample">
                    <div class="card card-body">
                        @foreach($transactionHistories as $key => $history)
                            <div class="row mb-2 mt-2">
                                <div class="col-12 col-lg-3">
                                    <span class="ml-2"><strong>{{ $key + 1 }}. Số xu giao dịch:</strong>
                                        {{ $history->coin_spent > 0 ?
                                        '+'.number_format($history->coin_spent, 0, ',', '.') :
                                         '-'.number_format($history->coin_spent, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <span class="ml-2"><strong>Nội dung:</strong> {{ $history->note }}</span>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <span><strong>Tổng xu:</strong> {{ $history->total_coin ? number_format($history->total_coin, 0, ',', '.') : '' }}</span>
                                </div>
                                <div class="col-12 col-lg-3">
                                    <span class="ml-2"><strong>Thời gian:</strong> {{ (new DateTime($history->created_at))->format('d/m/Y H:i:s') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
@section('js')

@endsection
