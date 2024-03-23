<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

    <!-- font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        .sidebar .nav-item .nav-link:hover {
            background-color: #3da49b !important;
            color: #fff !important;
        }
        .form-message {
            color: red;
        }
        .content-wrapper .content {
            padding-bottom: 80px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/cms/css/style.css') }}">
    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('admins.layouts.message')
<div class="wrapper">
    <!-- Navbar header -->
    @include('admins.layouts.header')
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 sidebar-light-lightblue">
        @include('admins.layouts.sidebar_menu')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <div style="margin-top: 40px">
        @include('admins.layouts.footer')
    </div>

    <aside class="control-sidebar control-sidebar-light">
        <ul class="nav-right-info">
            <li>
                <a href="#">
                    <i class="fa-solid fa-gear nav-icon"></i>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                    Logout
                </a>
            </li>
        </ul>
    </aside>
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
{{--<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>--}}


<script src="{{ asset('assets/cms/js/validateForm.js') }}"></script>
<script>
    // $(document).on('click', '.btn-delete', function () {
    //     let id = $(this).data('id');
    //     let log = $(this).data('log');
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: 'You won\'t be able to revert this!',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#007bff',
    //         cancelButtonColor: '#fd7e14',
    //         confirmButtonText: 'OK',
    //     }).then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 url : 'delete.php',
    //                 type : 'post',
    //                 dataType : 'json',
    //                 data : {
    //                     log : log,
    //                     id : id
    //                 },
    //                 success : function (data)
    //                 {
    //                     if(data.rs == true){
    //                         Swal.fire({
    //                             title: data.title ?? 'Deleted!',
    //                             text: data.msg,
    //                             icon: 'success',
    //                             willClose: () => {
    //                                 window.location.reload();
    //                             }
    //                         });
    //                     } else {
    //                         Swal.fire('Error', 'Failed to delete the record.', 'error');
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // })
    //
    // $(document).on('input', 'input[name=price], input[name=priceEdit]', function () {
    //     let inputValue = $(this).val();
    //     inputValue = inputValue.replace(/[^0-9.]/g, '');
    //     let formattedValue = numberWithCommas(parseFloat(inputValue).toFixed());
    //
    //     $(this).val(formattedValue);
    // })
    //
    // function numberWithCommas(number) {
    //     if (number === '' || isNaN(number)) {
    //         return '';
    //     }
    //
    //     return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    // }
</script>

@yield('js')
</body>
</html>
