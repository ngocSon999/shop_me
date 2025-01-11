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
    <div class="container-fluid fruite py-2">
        <div class="container py-2">
            <div class="tab-class text-center">
                <div class="row g-4 mb-4">
                    <strong style="color: #45595b; ">SẢN PHẨM {{ Str::upper($categoryName) }}</strong>
                </div>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4" id="product-list">
                            @foreach($products as $product)
                                <div class="col-md-6 col-lg-3 col-xl-4">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img border-bottom-0">
                                            <a href="{{ route('web.product.show', ['id' => $product->id]) }}">
                                                <img src="{{ asset($product->image) }}" class="img-fluid w-100 rounded-top" alt="">
                                            </a>
                                        </div>
                                        <div class="p-4 border-top-0 rounded-bottom">
                                            <a href=""><h4>{{ $product->name }}</h4></a>
                                            <span class="text-danger">Liên hệ</span>
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
    <!-- Fruits Shop End-->

    @include('frontend.layouts.featured_service')
@endsection

@section('js')
    <script>
        $('.product-category').on('click', function () {
            let categoryId = $(this).data('category_id');
            $.ajax({
                method: 'GET',
                url: '{{ route('web.getDataAjax') }}',
                data: { categoryId: categoryId },
                success: function (res) {

                }
            })
        })
    </script>
@endsection
