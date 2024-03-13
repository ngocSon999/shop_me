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
                                                        <p class="text-dark fs-5 fw-bold mb-0">{{ $product->price }} đ</p>
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
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="{{ asset('shopAcc/img/vegetable-item-6.jpg') }}" class="img-fluid w-100 rounded-top"
                             alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                         style="top: 10px; right: 10px;">Vegetable
                    </div>
                    <div class="p-4 rounded-bottom">
                        <h4>Parsely</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
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
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                           style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="{{ asset('shopAcc/img/testimonial-1.jpg') }}" class="img-fluid rounded"
                                     style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                           style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="{{ asset('shopAcc/img/testimonial-1.jpg') }}" class="img-fluid rounded"
                                     style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item img-border-radius bg-light rounded p-4">
                    <div class="position-relative">
                        <i class="fa fa-quote-right fa-2x text-secondary position-absolute"
                           style="bottom: 30px; right: 0;"></i>
                        <div class="mb-4 pb-4 border-bottom border-secondary">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing Ipsum has been the
                                industry's standard dummy text ever since the 1500s,
                            </p>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap">
                            <div class="bg-secondary rounded">
                                <img src="{{ asset('shopAcc/img/testimonial-1.jpg') }}" class="img-fluid rounded"
                                     style="width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="ms-4 d-block">
                                <h4 class="text-dark">Client Name</h4>
                                <p class="m-0 pb-3">Profession</p>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tastimonial End -->
@endsection

@section('footer')
@parent
@endsection
@section('js')

@endsection
