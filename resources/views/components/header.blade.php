@php use Illuminate\Support\Facades\Auth; @endphp
<style>
    #header {
        border: 3px dashed green;
    }

    #header.active {
        border: 3px dashed red;
    }

    @media (max-width: 767px) {
        .mobile-button {
            display: block;
        }
    }
</style>
<header id="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('web.index') }}">
                <img src="{{ asset('asset/image/logo.jpg') }}" width="80px" height="40px" alt="">
            </a>
            <button class="btn btn-outline-dark mobile-button d-md-none" id="mobileMenuButton">
                <i style="font-size: 30px" class="fas fa-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('web.index') }}"><i
                                class="fas fa-home me-3 text-secondary"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="menuDrop" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Danh mục phim
                        </a>
                        <ul id="menu-category" class="dropdown-menu menu-category" aria-labelledby="menuDrop">
                            @foreach($categories as $category)
                                <li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="movieTheater" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Rạp CGV
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="movieTheater">
                            <li><a class="dropdown-item" href="#">Tất cả các rạp</a></li>
                            <li><a class="dropdown-item" href="#">Rạp đặc biệt</a></li>
                            <li><a class="dropdown-item" href="#">Rạp 3D</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('web.logout') }}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('web.login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('web.customers.form') }}">Register</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>

