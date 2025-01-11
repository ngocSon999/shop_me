<div class="container-fluid vesitable mt-4">
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
                    <div class="text-white bg-dark px-3 py-1 rounded position-absolute"
                         style="bottom: 10px; right: 10px;">{{ $category->name }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
