@php use Illuminate\Support\Facades\Auth; @endphp
@extends('frontend.layouts.master')
@section('style')
    <style>
        .content-description {
            max-height: 228px;
            overflow: hidden;
        }
        .content-description.show {
            max-height: unset;
        }

        .content-description img {
            max-width: 100%;
            max-height: 400px;
        }
        .content-description table tr {
            border-bottom: none;
        }
        .image.image_resized {
            display: block;
            margin: 0 auto;
        }
        .show-detail-description:hover {
            color: #81c408;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid vesitable" style="margin-top: 108px">
        <div class="container py-3">
            <h1 class="mb-0">Chi tiết sản phẩm</h1>
            <div class="row product-detail">
                <div class="col-12 col-md-6">
                    <img src="{{ asset($product->image) }}" style="width: 100%; max-height: 500px" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <p>Tên sản phẩm: {{ $product->name }}</p>
                    <p>GIá sản phẩm: {{ $product->price }}</p>
                    <p>Mô tả:</p>
                    <div class="content-description">{!! $product->description !!}</div>
                    <p class="d-flex justify-content-end">
                        <span class="show-detail-description" type="button">Chi tiết</span>
                    </p>
                    <form action="{{ route('web.purchase_product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn border border-secondary rounded-pill px-3 text-primary">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Vesitable Shop Start-->
    <div class="container-fluid vesitable py-3">
        <div class="container py-3">
            <h1 class="mb-0">Fresh Organic Vegetables</h1>
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
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="{{ asset('shopAcc/img/vegetable-item-1.jpg') }}" class="img-fluid w-100 rounded-top"
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
@endsection

@section('js')
    <script>
        $(document).on('click', '.show-detail-description', function () {
            let $element = $(this).parent().parent().find('.content-description');
            $element.toggleClass('show');
            if ($(this).text() == 'Chi tiết') {
                $(this).text('Thu gọn')
            } else {
                $(this).text('Chi tiết')
            }
        })
    </script>
@endsection
