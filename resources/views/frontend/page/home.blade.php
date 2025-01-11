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
    <!-- Banner -->
    @include('frontend.layouts.banner')
    <!-- Hero Banner -->

    <!-- Fruits Shop Start-->
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-12">
                <h1>Về chúng tôi</h1>
                <div style="text-align: justify">{{ getSetting('description_about_us') ?? '' }}</div>
            </div>
            <div class="col-lg-5 col-12" style="height: 250px; overflow: hidden">
                <div id="carouselExample" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach($categories as $key => $category)
                            <div class="carousel-item rounded {{ $key === 0 ? 'active' : '' }}">
                                <img style="height: 250px" src="{{ asset($category->image) }}" class="img-fluid w-100 rounded"
                                     alt="First slide">
                            </div>
                        @endforeach
                    </div>
                    <button style="background: transparent" class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button style="background: transparent" class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

    @include('frontend.layouts.featured_service')

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
