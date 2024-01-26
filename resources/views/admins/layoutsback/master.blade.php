<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('library/bootstrap/cdn.jsdelivr.net_npm_bootstrap@5.0.2_dist_css_bootstrap.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('asset/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('library/timepicker/jquery-ui-timepicker-addon.min.css') }}">
{{--    <link rel="stylesheet" href="{{ asset('asset/font/font-awesome_all.min.css') }}">--}}
    <!-- datatable-->
    <link rel="stylesheet" href="{{ asset('library/datatable/dataTables.min.css') }}">

    <!--jquery-->
    <script src="{{ asset('asset/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery_ui_1.12.1.min.js') }}"></script>
    <!-- timepicker-->
    <script src="{{ asset('library/timepicker/jquery-ui-timepicker-addon.min.js') }}"></script>
    <script src="{{ asset('library/timepicker/i18n_jquery-ui-timepicker-vi.js') }}"></script>

    <!--bootstrap-->
    <script src="{{ asset('library/bootstrap/bootstrap5.0.2.bundle.min.js') }}"></script>
    <!-- datatable-->
    <script src="{{ asset('library/datatable/dataTables.min.js') }}"></script>

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/css/form.css') }}">
    <!-- bootstrap datepicker-->
    <style>
        .btn-close {
            position: absolute;
            top: 2px;
            right: 0;
        }
        .btn-close:hover {
            border: 1px solid chartreuse;
            border-radius: 4px;
            background-color: #00ffa5;
        }
        .alert {
            margin-top: 30px;
            height: 70px;
        }
        table.dataTable.no-footer {
            border: 1px solid rgba(0, 0, 0, 0.3);
            margin-top: 40px;
        }
        #myTableUser_filter {
            margin-bottom: 10px;
        }
        .dataTables_filter {
            margin-bottom: 10px;
        }

    </style>
    @yield('style')
</head>
<body>
<div class="container" id="main">
    <div class="row mt-4">
        @include('admins.layouts.header')
    </div>
    <div class="row">
        <div><i class="fas fa-bars" id="main-menu"></i></div>
    </div>
    <div class="row">
        <div class="col-md-3 mt-4" id="sidebar">
            @section('sidebar')
                @include('admins.layouts.component.sidebar')
            @show
        </div>
        <div class="col-md-9 col-12" id="main-content">
            <div class="row d-flex justify-content-center mb-4">
                @include('admins.layouts.message')
            </div>
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="row">
        @include('admins.layouts.footer')
    </div>
</div>
<script src="{{ asset('/admin/js/page-app.js') }}"></script>
<script>
    $('#main-menu').on('click', function () {
        $('#sidebar').toggle()
        $('#main-content').toggleClass('col-md-9 col-12');
    })
</script>
@yield('js')
</body>
</html>
