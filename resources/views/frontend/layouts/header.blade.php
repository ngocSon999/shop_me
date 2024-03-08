@php use Illuminate\Support\Facades\Auth; @endphp
<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('web.index') }}" class="navbar-brand"><img src="{{ asset('/shopAcc/img/NRO.png') }}" height="80" width="130" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('web.index') }}" class="nav-item nav-link active">Trang chủ</a>
                    <a href="{{ route('web.recharge', ['slug' => 'nap-the-cao']) }}" class="nav-item nav-link">Nạp thẻ cào</a>
                    <a href="{{ route('web.recharge', ['slug' => 'nap-momo-atm']) }}" class="nav-item nav-link">Nạp Momo/ATM</a>
{{--                    <div class="nav-item dropdown">--}}
{{--                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>--}}
{{--                        <div class="dropdown-menu m-0 bg-secondary rounded-0">--}}
{{--                            <a href="#" class="dropdown-item">Cart</a>--}}
{{--                            <a href="#" class="dropdown-item">Chackout</a>--}}
{{--                            <a href="#" class="dropdown-item">Testimonial</a>--}}
{{--                            <a href="#" class="dropdown-item">404 Page</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <a href="#" class="nav-item nav-link">Tin tức</a>
                    <a href="#" class="nav-item nav-link">Liên hệ</a>
                    @if(!Auth::check())
                        <a href="{{ route('web.customers.form') }}" class="nav-item nav-link">Đăng ký</a>
                        <a href="{{ route('web.login') }}" class="nav-item nav-link">Đăng nhập</a>
                    @endif
                </div>
                <div class="d-flex m-3 me-0 align-items-center">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                            data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search text-primary"></i>
                    </button>
                    @if(Auth::check())
                        <a href="#" class="position-relative me-4 my-auto d-flex align-items-center">
                            <i class="fa fa-bell" style="font-size: 28px"></i>
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;"></span>
                        </a>
                        <div class="nav-item dropdown">
                            <a href="#" class="my-auto d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
                                @if(!empty(Auth::user()->avatar))
                                    <img src="{{ asset(Auth::user()->avatar) }}" alt="" width="30" height="30" style="border-radius: 50%">
                                @else
                                    <i class="fas fa-user" style="font-size: 28px"></i>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                                <span> - </span>
                                <span>${{ Auth::user()->coin }}</span>
                            </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Acount</a>
                                <a href="{{ route('web.customers.history') }}" class="dropdown-item"><i class="fas fa-history"></i> Lịch sử</a>
                                <a href="{{ route('web.logout') }}" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
