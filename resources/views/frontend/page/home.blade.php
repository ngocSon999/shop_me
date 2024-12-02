@php use Illuminate\Support\Facades\Auth; @endphp
@extends('frontend.layouts.master')
@section('style')
    <style>
        .pagination {
            display: flex;
            margin-top: 20px;
        }
    </style>
@endsection
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-2">
            <div class="row g-5 align-items-center">
                <div class="col-md-12">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @foreach($banners as $key => $banner)
                                <div class="carousel-item rounded {{ $key === 0 ? 'active' : '' }}">
                                    <img src="{{ asset($banner->image) }}" class="img-fluid w-100 bg-secondary rounded"
                                         alt="First slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">{{ $banner->name }}</a>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-2">
        <div class="container py-2">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="text-start">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 bg-light rounded-pill active" href="{{ route('web.index') }}"
                                   data-category_id="all">
                                    <span class="text-dark" style="width: 130px;">Tất cả</span>
                                </a>
                            </li>

                            @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill product-category"
                                       href="{{ route('web.product_category', ['slug' => $category->slug]) }}">
                                        <span class="text-dark" style="min-width: 130px; padding: 0 6px">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-all" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4" id="product-list">
                                    @foreach($products as $product)
                                        <div class="col-md-6 col-xl-4">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img border-bottom-0">
                                                    <img src="{{ asset($product->image) }}"
                                                         class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="p-2 border-top-0 rounded-bottom">
                                                    <h3>{{ $product->name }}</h3>
                                                    <div class="product-description">{!! $product->description !!}</div>
                                                    <div class="d-flex justify-content-between flex-md-wrap">
                                                        @if($product->new_price)
                                                            <p class="text-dark fs-5 fw-bold mb-0"
                                                               style="text-decoration: line-through; font-size: 12px">{{ $product->price }} đ</p>
                                                            <p class="text-dark fs-5 fw-bold mb-0">{{ $product->new_price }} đ</p>
                                                        @else
                                                            <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }} đ</p>
                                                        @endif
                                                        <button class="btn border border-secondary rounded-pill px-3 text-primary btn-by-product"
                                                        data-product_id="{{ $product->id }}">
                                                            <i class="fa fa-shopping-bag me-2 text-primary"></i>Mua
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div>{{ $products->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

    <!-- Vesitable Shop Start-->
    <div class="container-fluid vesitable">
        <div class="container py-3">
            <h3 class="mb-0 d-block text-center">DỊCH VỤ NỔI BẬT</h3>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                @foreach($categories as $category)
                    <div class="border border-grey rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="{{ asset($category->image) }}" class="img-fluid w-100 rounded-top"
                                 alt="" style="height: 300px">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                             style="top: 10px; right: 10px;">{{ $category->name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Vesitable Shop End -->

    <!-- Tastimonial Start -->
    <div class="container-fluid testimonial">
        <div class="container py-3">
            <div class="testimonial-header text-center">
                <h3 class="mb-0 d-block text-center">Đánh giá của khách hàng</h3>
            </div>
            <div class="owl-carousel testimonial-carousel">
                @foreach($feedbacks as $feedback)
                    <div class="testimonial-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                               style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">
                                    {{ $feedback->message }}
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="{{ asset($feedback->customer->avatar) }}" class="img-fluid rounded"
                                         style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">{{ $feedback->customer->name }}</h4>
                                    <p class="m-0 pb-3"></p>
                                    <div class="d-flex pe-5">
                                        @php
                                            $rating = $feedback->rating;
                                        @endphp
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star {{ $i < $rating ? ' text-primary' : '' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Tastimonial End -->
@endsection

@section('footer')
@parent
@endsection
@section('js')
    @if(isset($notifyPage))
        <script>
            let notifyPage = @json($notifyPage);
            $(document).ready(function () {
                if (notifyPage.title && notifyPage.content) {
                    $('.modal-notification .modal-title').text(notifyPage.title);
                    $('.modal-notification .modal-body').html(notifyPage.content);
                    $('.modal-notification').modal('show');
                }
            });
        </script>
    @endif
@endsection
