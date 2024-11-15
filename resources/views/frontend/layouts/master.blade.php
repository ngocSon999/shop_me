<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('shopAcc/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('shopAcc/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('shopAcc/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('shopAcc/css/style_setup.css') }}" rel="stylesheet">
    <link href="{{ asset('shopAcc/css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset(getSetting('logo_favicon')) }}" type="image/x-icon">
    <title>Website | @yield('title')</title>
    @yield('style')
    @yield('style')
</head>
<body>
<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
@include('frontend.layouts.header')
@include('frontend.layouts.message')
<!-- Modal Search Start -->
<div style="height: unset" class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <form action="" class="input-group w-75 mx-auto d-flex">
                    <input type="text" class="form-control p-1" name="keyword" placeholder="Nhập từ tìm kiếm..." aria-describedby="search-icon-1">
                    <button class="input-group-text p-1" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->

<div class="container-fluid">
    @yield('content')
</div>

@section('footer')
    @include('frontend.layouts.footer')
@show

<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('shopAcc/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('shopAcc/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('shopAcc/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('shopAcc/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<script src="{{ asset('/frontend/js/pusher.min.js') }}"></script>
<!-- Template Javascript -->
<script src="{{ asset('shopAcc/js/main.js') }}"></script>
<script>
    // Pusher.logToConsole = true;
    const app_key = '{{ env('VITE_PUSHER_APP_KEY') }}';
    let pusher = new Pusher(app_key, {
        cluster: 'ap1',
        encrypted: true
    });
    let channel = pusher.subscribe('NotifyChangeCoin');
    channel.bind('App\\Events\\ChangeCoin', function(e) {
        document.getElementById('total-coin').innerText= e.customer.coin;
    });

    // let notify = pusher.subscribe('Send-Notify-Recharge-Card');
    // notify.bind('App\\Events\\SendNotifyRechargeCard', function(e) {
    //     let notifications = e.notifications.data;
    //     let $element = $('#notify');
    //     console.log(notifications);
    // });


    $(document).on('click', '.btn-by-product', function () {
        let productId = $(this).data('product_id');
        let userLogin = @json(auth()->user());
        {{--let userLogin = '{{ auth()->user() }}';--}}
        if (!userLogin) {
        alert('Vui lòng đăng nhập để sử dụng dịch vụ vủa chúng tôi!')
        } else {
            let pathProductDetail = '{{ route('web.product.show', ':id') }}';
            pathProductDetail = pathProductDetail.replace(':id', productId);

            window.location.href = pathProductDetail;
        }
    })
</script>
@yield('js')
</body>
</html>
