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
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12">
                <h1>Về chúng tôi</h1>
                <div>{{ getSetting('description_about_us') ?? '' }}</div>
            </div>
            <div class="col-lg-5 col-12" style="height: 250px; overflow: hidden">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach($categories as $key => $category)
                            <div class="carousel-item rounded {{ $key === 0 ? 'active' : '' }}">
                                <img style="height: 250px" src="{{ asset($category->image) }}" class="img-fluid w-100 rounded"
                                     alt="First slide">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

    <!-- Vesitable Shop Start-->
    <div class="container-fluid vesitable">
        <div class="container py-3">
            <h3 class="mb-0 d-block text-center mb-3 mb-lg-0">DỊCH VỤ NỔI BẬT</h3>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                @foreach($categories as $category)
                    <div class="border border-grey rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <a href="{{ route('web.product_category', ['slug' => $category->slug]) }}">
                                <img src="{{ asset($category->image) }}" class="img-fluid w-100 rounded-top"
                                     alt="" style="height: 300px">
                            </a>
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                             style="top: 10px; right: 10px;">{{ $category->name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
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
