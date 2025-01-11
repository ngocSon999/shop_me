
<a href="{{ route('admin.dashboard') }}" class="brand-link d-flex justify-content-center" style="height: 77px; padding: 4px">
    <img src="{{ asset(getSetting('logo_page_admin')) }}" alt="Logo" class=""
         style="display: block; width: 100%; height: 100%;  align-items: center"
    >
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
                <a href="{{ route('admin.feedback.index') }}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Feedback</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.contacts.index') }}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Contact</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.banks.index') }}" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>Bank</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.cards.index') }}" class="nav-link">
                    <i class="far fa-credit-card"></i>
                    <p>Card</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-list nav-icon"></i>
                    <p>
                        Setting web
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index', ['slug' => 'contact']) }}" class="nav-link">
                            <p class="nav-link-item">contact</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index', ['slug' => 'mail']) }}" class="nav-link">
                            <p class="nav-link-item">Mail</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index', ['slug' => 'logo']) }}" class="nav-link">
                            <p class="nav-link-item">Logo</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index', ['slug' => 'notification']) }}" class="nav-link">
                            <p class="nav-link-item">Notification</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index', ['slug' => 'description']) }}" class="nav-link">
                            <p class="nav-link-item">Description</p>
                        </a>
                    </li>
                </ul>
            </li>

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
