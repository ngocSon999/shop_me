<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="{{ asset('library/bootstrap/bootstrap5.0.2.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css">
{{--    <link rel="stylesheet" href="{{ asset('asset/css/jquery-ui-timepicker-addon.min.css') }}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"/>

    <!--jquery-->
    <script src="{{ asset('asset/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery_ui_1.12.1.min.js') }}"></script>
    <!--bootstrap-->
    <script src="{{ asset('library/bootstrap/bootstrap5.0.2.bundle.min.js') }}"></script>
    <!-- timepicker-->
    <script src="{{ asset('library/timepicker/jquery-ui-timepicker-addon.min.js') }}"></script>
    <script src="{{ asset('library/timepicker/i18n_jquery-ui-timepicker-vi.js') }}"></script>

    <!-- slick-carousel-->
{{--    <link rel="stylesheet" href="{{ asset('library/slick_slides/style.css') }}"/>--}}
    <script src="{{ asset('library/slick_slides/slick-slider_1.8.1_slick.min.js') }}"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <title>@yield('title')</title>
    <style>
        /*#menu-category::before {*/
        /*    content: "";*/
        /*    position: absolute;*/
        /*    top: -20px;*/
        /*    left: 0;*/
        /*    width: 100%;*/
        /*    height: 20px;*/
        /*    background-color: red;*/
        /*}*/
    </style>
    @yield('style')
</head>
<body>
    <div id="main">
        <div class="container">
            <div class="row">
                <x-header />
            </div>
            <div class="row">
                @include('frontend.layouts.message')
            </div>
            <div class="row mt-4">
                @yield('content')
            </div>
            <div class="row">
                @include('frontend.layouts.footer')
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.nav-item.dropdown').on('mouseenter', function () {
                $(this).find('ul').show()
            })
            $('.nav-item.dropdown').find('ul').on('mouseleave', function () {
                $(this).hide();
            });

            setInterval(function () {
                $('#header').toggleClass('active')
            }, 300);

            $('.mobile-button').on('click', function () {
                $('.collapse:not(.show)').toggle()
            })
        });
    </script>
@yield('js')
</body>
</html>
