
<a href="{{ route('admin.dashboard') }}" class="brand-link d-flex justify-content-center" style="height: 77px; padding: 4px">
    <img src="{{ asset('dist/img/logo.jpeg') }}" alt="GiftshopBitel Logo" class="" style="display: block; width: 100%; height: 100%;  align-items: center">
</a>

<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Product</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.banners.index') }}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Banner</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.customers.index') }}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Customer</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.banks.index') }}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Bank</p>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a href="#" class="nav-link">--}}
{{--                    <i class="fa-solid fa-list nav-icon"></i>--}}
{{--                    <p>--}}
{{--                        Product & Benefit--}}
{{--                        <i class="fas fa-angle-left right"></i>--}}
{{--                    </p>--}}
{{--                </a>--}}
{{--                <ul class="nav nav-treeview">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ route('admin.movies.index') }}" class="nav-link">--}}
{{--                            <p class="nav-link-item">Product</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link">--}}
{{--                            <p class="nav-link-item">Benefit</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>Account</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>Role</p>
                </a>
            </li>
            <li class="nav-item mt-3">
                <a href="{{ route('admin.user.logout') }}" class="nav-link">
                    <i class="fa-solid fa-right-from-bracket nav-icon"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
