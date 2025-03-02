@php use Illuminate\Support\Facades\Auth; @endphp
<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('web.index') }}" class="navbar-brand"><img src="{{ asset(getSetting('logo_header')) }}" height="80" width="130" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('web.index') }}" class="nav-item nav-link active">TRANG CHỦ</a>
                    <a href="{{ route('web.index') }}" class="nav-item nav-link">GIỚI THIỆU</a>
{{--                    <a href="{{ route('web.recharge', ['slug' => 'nap-the-cao']) }}" class="nav-item nav-link">Nạp thẻ cào</a>--}}
{{--                    <a href="{{ route('web.recharge', ['slug' => 'nap-momo-atm']) }}" class="nav-item nav-link">Nạp Momo/ATM</a>--}}
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">SẢN PHẨM</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    <a href="{{ route('web.product_category', ['slug' => $category->slug]) }}" class="dropdown-item">{{ $category->name }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('web.contact') }}" class="nav-item nav-link">TIN TỨC</a>
                    <a href="{{ route('web.contact') }}" class="nav-item nav-link">LIÊN HỆ</a>
{{--                    @if(!Auth::check())--}}
{{--                        <a href="{{ route('web.customers.form') }}" class="nav-item nav-link">Đăng ký</a>--}}
{{--                        <a href="{{ route('web.login') }}" class="nav-item nav-link">Đăng nhập</a>--}}
{{--                    @endif--}}
                </div>
                <div class="d-flex m-3 me-0 align-items-center">
                    @if(Auth::check())
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                                data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search text-primary"></i>
                        </button>
                        <span class="notification position-relative me-4 my-auto d-flex align-items-center">
                            <i class="fa fa-bell" style="font-size: 28px; color: var(--bs-primary)"></i>
                            <span
                                id = "total-notification"
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                {{ Auth::user()->unreadNotifications()->count() ?? 0 }}
                            </span>
                            <ul class="header-notification">
                                @if(Auth::user()->unreadNotifications()->count() > 0)
                                    @foreach (Auth::user()->unreadNotifications()->get() as $notification)
                                    <li class="notification-item">
                                        <a class="notification-link" href="#">
                                            {{ $notification->data['message_to_information'] }}
                                        </a>
                                        <i class="bi bi-x add-markAsRead" data-notification_id="{{ $notification->id }}"></i>
                                    </li>
                                    @endforeach
                                @else
                                    <li class="notification-item">
                                        <a class="notification-link" href="#">
                                           No notification
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </span>
                        <div class="nav-item dropdown">
                            <a href="#" class="my-auto d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
                                @if(!empty(Auth::user()->avatar))
                                    <img src="{{ asset(Auth::user()->avatar) }}" alt="" width="30" height="30" style="border-radius: 50%">
                                @else
                                    <i class="fas fa-user" style="font-size: 28px"></i>
                                @endif
                                <span class="me-2 ms-1">{{ Auth::user()->name }}</span>
                                <span id="total-coin">{{ number_format(Auth::user()->coin, 0, ',', '.') }}</span>
                            </a>
                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{ route('web.customers.profile') }}" class="dropdown-item"><i class="fas fa-cog"></i>Profile</a>
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
