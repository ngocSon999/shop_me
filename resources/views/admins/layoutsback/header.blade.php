<ul class="nav nav-tabs justify-content-space-between">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">Home</a>
    </li>
    <div id="header-profile">
        @if(!Sentinel::getUser())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.login') }}">Đăng nhập</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.logout') }}">Đăng xuất</a>
            </li>
        @endif
    </div>

</ul>
<!--<div class="preloader flex-column justify-content-center align-items-center">-->
<!--    <img class="animation__shake" src="dist/img/bitel-logo.svg" alt="AdminLTELogo" height="60" width="60">-->
<!--</div>-->
<nav class="main-header navbar navbar-expand navbar-white navbar-light layout-fixed">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" data-widget="navbar-search" href="#" role="button">-->
        <!--                <i class="fas fa-search"></i>-->
        <!--            </a>-->
        <!--            <div class="navbar-search-block">-->
        <!--                <form class="form-inline">-->
        <!--                    <div class="input-group input-group-sm">-->
        <!--                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">-->
        <!--                        <div class="input-group-append">-->
        <!--                            <button class="btn btn-navbar" type="submit">-->
        <!--                                <i class="fas fa-search"></i>-->
        <!--                            </button>-->
        <!--                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">-->
        <!--                                <i class="fas fa-times"></i>-->
        <!--                            </button>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </form>-->
        <!--            </div>-->
        <!--        </li>-->
    </ul>
    <ul class="navbar-nav ml-auto">
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" href="#" role="button">-->
        <!--                <i class="fas fa-bell"></i>-->
        <!--            </a>-->
        <!--        </li>-->
        <li class="nav-item">
            <a class="nav-link" href="#">
                <img src="{{ asset('assets/images/user-default.png') }}" alt="" style="width: 25px; height: 25px; border-radius: 50%">
            </a>
        </li>
        <!--        <li class="nav-item">-->
        <!--            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">-->
        <!--                <i class="fas fa-ellipsis-h"></i>-->
        <!--            </a>-->
        <!--        </li>-->
    </ul>
</nav>
