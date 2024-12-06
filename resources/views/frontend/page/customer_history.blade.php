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
            <div class="row mb-2 mt-3 g-1">
                @foreach($products as $key => $product)
                <div class="col-12 col-lg-6">
                    <div class=" mb-2 p-2 product-history">
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
                </div>
                @endforeach
            </div>

            <div class="row mb-2 pb-1 mt-3">
                <!-- Tabs navigation -->
                <ul class="nav nav-tabs" id="transactionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history-tab-pane" type="button" role="tab" aria-controls="history-tab-pane" aria-selected="false">
                            <i class="fas fa-history"></i> Lịch sử giao dịch xu
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="card-tab" data-bs-toggle="tab" data-bs-target="#card-tab-pane" type="button" role="tab" aria-controls="card-tab-pane" aria-selected="false">
                            <i class="fas fa-wallet"></i> Lịch sử nạp thẻ cào
                        </button>
                    </li>
                </ul>

                <!-- Tabs content -->
                <div class="tab-content mt-3" id="transactionTabContent">
                    <!-- Tab 1: Lịch sử giao dịch xu -->
                    <div class="tab-pane fade" id="history-tab-pane" role="tabpanel" aria-labelledby="history-tab">
                        <div class="card card-body">
                            @foreach($transactionHistories as $key => $history)
                                <div class="row mb-2 mt-2">
                                    <div class="col-12 col-lg-3">
                            <span class="ml-2"><strong>{{ $key + 1 }}. Số xu giao dịch:</strong>
                                {{ $history->coin_spent > 0 ? '+' . number_format($history->coin_spent, 0, ',', '.') : '-' . number_format($history->coin_spent, 0, ',', '.') }}
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

                    <!-- Tab 2: Lịch sử nạp thẻ cào -->
                    <div class="tab-pane fade" id="card-tab-pane" role="tabpanel" aria-labelledby="card-tab">
                        <div class="card card-body">
                            @if(!empty($cards))
                                @foreach($cards as $key => $card)
                                    <div class="row mb-2 mt-2">
                                        <div class="col-12 col-lg-2">
                                            <span class="ml-2"><strong>{{ $key + 1 }}. Loại thẻ: {{ config('define.TYPE_CARD.' . $card->type) }}</strong></span>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <span class="ml-2"><strong>Mệnh giá:</strong> {{ $card->card_price }}</span>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <span class="ml-2"><strong>Số seri:</strong> {{ $card->serial }}</span>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <span><strong>Số thẻ:</strong> {{ $card->number }}</span>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            @php
                                                $color = $card->status == 1 ? 'text-success' : ($card->status == 2 ? 'text-danger' : '');
                                            @endphp
                                            <strong>Trạng thái:</strong>
                                            <span class="ms-1 {{ $color }}">{{ config('define.STATUS_CARD.' . $card->status) }}</span>
                                        </div>
                                        <div class="col-12 col-lg-2">
                                            <span class="ml-2"><strong>Thời gian:</strong> {{ (new DateTime($card->created_at))->format('d/m/Y H:i:s') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection
@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll('#transactionTabs .nav-link');
            tabs.forEach(tab => {
                tab.addEventListener('click', function (event) {
                    const target = document.querySelector(this.dataset.bsTarget);
                    if (target.classList.contains('show') && target.classList.contains('active')) {
                        target.classList.remove('show', 'active');
                    } else {
                        target.classList.add('show', 'active');
                    }
                });
            });
        });
    </script>
@endsection
