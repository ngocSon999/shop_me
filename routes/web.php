<?php

/*
 * Route admin
 */

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;

/*
 * Route web
 */
use App\Http\Controllers\Frontend\WebController;
use App\Http\Controllers\Frontend\FrontendLoginController;
use App\Http\Controllers\Frontend\MovieController as FrontendMovieController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;


Route::get('/admin/login', [LoginController::class, 'login'])->name('admin.user.login');
Route::post('/admin/user/postLogin', [LoginController::class, 'postLogin'])
    ->name('admin.user.post-login');

Route::middleware('sentinel.auth')
    ->prefix('/admin')
    ->name('admin.')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

    Route::get('/', [DashboardController::class, 'index'])
        ->middleware('checkPermission:dashboard.index')
        ->name('dashboard');

    Route::prefix('/user')->name('users.')->group(function () {
        Route::get('/create', [UserController::class, 'createForm'])
            ->middleware('checkPermission:users.create')
            ->name('form');

        Route::post('/store', [UserController::class, 'create'])
            ->middleware('checkPermission:users.create')
            ->name('create');

        Route::get('/index', [UserController::class, 'index'])
            ->middleware('checkPermission:users.list')
            ->name('index');

        Route::get('/list', [UserController::class, 'getList'])
            ->middleware('checkPermission:users.list')
            ->name('list');

        Route::get('/edit/{id}', [UserController::class, 'edit'])
            ->middleware('checkPermission:users.show')
            ->name('edit');

        Route::put('/update/{id}', [UserController::class, 'update'])
            ->middleware('checkPermission:users.edit')
            ->name('update');

        Route::get('/delete/{id}', [UserController::class, 'delete'])
            ->middleware('checkPermission:users.delete')
            ->name('delete');
    });

    Route::prefix('/banners')->name('banners.')->group(function () {
        Route::get('/create', [BannerController::class, 'createForm'])
            ->middleware('checkPermission:banners.create')
            ->name('form');

        Route::post('/store', [BannerController::class, 'store'])
            ->middleware('checkPermission:banners.create')
            ->name('store');

        Route::get('/index', [BannerController::class, 'index'])
            ->middleware('checkPermission:banners.list')
            ->name('index');

        Route::get('/list', [BannerController::class, 'getList'])
            ->middleware('checkPermission:banners.list')
            ->name('list');

        Route::get('/edit/{banner}', [BannerController::class, 'edit'])
            ->middleware('checkPermission:banners.edit')
            ->name('edit');

        Route::put('/update/{banner}', [BannerController::class, 'update'])
            ->middleware('checkPermission:banners.edit')
            ->name('update');

        Route::get('/delete/{banner}', [BannerController::class, 'delete'])
            ->middleware('checkPermission:banners.delete')
            ->name('delete');
    });

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/create', [CategoryController::class, 'createForm'])
            ->middleware('checkPermission:categories.create')
            ->name('form');

        Route::post('/store', [CategoryController::class, 'store'])
            ->middleware('checkPermission:categories.create')
            ->name('store');

        Route::get('/index', [CategoryController::class, 'index'])
            ->middleware('checkPermission:categories.list')
            ->name('index');

        Route::get('/list', [CategoryController::class, 'getList'])
            ->middleware('checkPermission:categories.create')
            ->name('list');

        Route::get('/edit/{id}', [CategoryController::class, 'edit'])
            ->middleware('checkPermission:categories.edit')
            ->name('edit');

        Route::put('/update/{id}', [CategoryController::class, 'update'])
            ->middleware('checkPermission:categories.edit')
            ->name('update');

        Route::get('/delete/{id}', [CategoryController::class, 'delete'])
            ->middleware('checkPermission:categories.delete')
            ->name('delete');
    });

    Route::prefix('/products')->name('products.')->group(function () {
        Route::get('/create', [ProductController::class, 'createForm'])
            ->middleware('checkPermission:products.create')
            ->name('form');

        Route::post('/store', [ProductController::class, 'store'])
            ->middleware('checkPermission:products.create')
            ->name('store');

        Route::get('/index', [ProductController::class, 'index'])
            ->middleware('checkPermission:products.list')
            ->name('index');

        Route::get('/list', [ProductController::class, 'getList'])
            ->middleware('checkPermission:products.list')
            ->name('list');

        Route::get('/edit/{product}', [ProductController::class, 'edit'])
            ->middleware('checkPermission:products.edit')
            ->name('edit');

        Route::put('/update/{product}', [ProductController::class, 'update'])
            ->middleware('checkPermission:products.edit')
            ->name('update');

        Route::get('/delete/{product}', [ProductController::class, 'delete'])
            ->middleware('checkPermission:products.delete')
            ->name('delete');
    });

    Route::prefix('/roles')->name('roles.')->group(function () {
        Route::get('/create', [RoleController::class, 'createForm'])
            ->middleware('checkPermission:roles.create')
            ->name('form');

        Route::post('/store', [RoleController::class, 'store'])
            ->middleware('checkPermission:roles.create')
            ->name('store');

        Route::get('/index', [RoleController::class, 'index'])
            ->middleware('checkPermission:roles.list')
            ->name('index');

        Route::get('/list', [RoleController::class, 'getList'])
            ->middleware('checkPermission:roles.list')
            ->name('list');

        Route::get('/edit/{id}', [RoleController::class, 'edit'])
            ->middleware('checkPermission:roles.edit')
            ->name('edit');

        Route::put('/update/{id}', [RoleController::class, 'update'])
            ->middleware('checkPermission:roles.edit')
            ->name('update');

        Route::get('/delete/{id}', [RoleController::class, 'delete'])
            ->middleware('checkPermission:roles.delete')
            ->name('delete');
    });

    Route::prefix('/customers')->name('customers.')->group(function () {
        Route::get('/create', [CustomerController::class, 'createForm'])
            ->middleware('checkPermission:customers.create')
            ->name('form');

        Route::get('/index', [CustomerController::class, 'index'])
            ->middleware('checkPermission:customers.list')
            ->name('index');

        Route::get('/list', [CustomerController::class, 'getList'])
            ->middleware('checkPermission:customers.list')
            ->name('list');

        Route::get('/show/{id}', [CustomerController::class, 'show'])
            ->middleware('checkPermission:customers.show')
            ->name('show');

        Route::get('/add-coin/{id}', [CustomerController::class, 'editCoin'])
            ->middleware('checkPermission:customers.edit')
            ->name('edit_coin');

        Route::put('/update/{id}', [CustomerController::class, 'update'])
            ->middleware('checkPermission:customers.edit')
            ->name('update');

        Route::patch('/update/{id}', [CustomerController::class, 'addCoin'])
            ->middleware('checkPermission:customers.edit')
            ->name('add_coin');

        Route::get('/delete/{id}', [CustomerController::class, 'delete'])
            ->middleware('checkPermission:customers.delete')
            ->name('delete');

        Route::get('/transaction-history/{id}', [CustomerController::class, 'transactionHistory'])
            ->middleware('checkPermission:customers.show')
            ->name('transaction_history');

        Route::post('/change-password', [CustomerController::class, 'updatePassword'])
            ->middleware('checkPermission:customers.edit')
            ->name('change_password');

        Route::post('/change-status', [CustomerController::class, 'changeStatus'])
            ->middleware('checkPermission:customers.edit')
            ->name('change_status');
    });

    Route::prefix('/banks')->name('banks.')->group(function () {
        Route::get('/create', [BankController::class, 'createForm'])
            ->middleware('checkPermission:banks.create')
            ->name('form');

        Route::post('/store', [BankController::class, 'store'])
            ->middleware('checkPermission:banks.create')
            ->name('store');

        Route::get('/index', [BankController::class, 'index'])
            ->middleware('checkPermission:banks.list')
            ->name('index');

        Route::get('/list', [BankController::class, 'getList'])
            ->middleware('checkPermission:banks.list')
            ->name('list');

        Route::get('/edit/{id}', [BankController::class, 'edit'])
            ->middleware('checkPermission:banks.edit')
            ->name('edit');

        Route::put('/update/{id}', [BankController::class, 'update'])
            ->middleware('checkPermission:banks.edit')
            ->name('update');

        Route::get('/delete/{id}', [BankController::class, 'delete'])
            ->middleware('checkPermission:banks.delete')
            ->name('delete');
    });

    Route::prefix('/cards')->name('cards.')->group(function () {
        Route::get('/index', [CardController::class, 'index'])
            ->middleware('checkPermission:cards.list')
            ->name('index');

        Route::get('/list', [CardController::class, 'getList'])
            ->middleware('checkPermission:cards.list')
            ->name('list');

        Route::put('/update/{id}', [CardController::class, 'update'])
            ->middleware('checkPermission:cards.edit')
            ->name('update');

        Route::get('/delete/{id}', [CardController::class, 'delete'])
            ->middleware('checkPermission:cards.delete')
            ->name('delete');
    });

    Route::prefix('/setting')->name('setting.')->group(function () {
        Route::put('/update/{id}', [SettingController::class, 'update'])
            ->middleware('checkPermission:settings.edit')
            ->name('update');
        Route::post('/update-logo/{id}', [SettingController::class, 'updateLogo'])
            ->middleware('checkPermission:settings.edit')
            ->name('update-logo');
        Route::get('/{slug}', [SettingController::class, 'index'])
            ->middleware('checkPermission:settings.list')
            ->name('index');
    });
});

/*
 * register route web
 */
Route::get('', [WebController::class, 'index'])->name('web.index');
Route::get('/login', [FrontendLoginController::class, 'index'])->name('web.login');
Route::post('/login', [FrontendLoginController::class, 'login'])->name('web.login.store');


Route::prefix('customers')->group(function () {
    Route::get('/create', [FrontendCustomerController::class, 'createForm'])
        ->name('web.customers.form');
    Route::post('/register', [FrontendCustomerController::class, 'store'])
        ->name('web.customers.register');
});

Route::middleware(['auth.customers'])->group(function () {
    Route::get('/logout', [FrontendLoginController::class, 'logout'])->name('web.logout');
    Route::prefix('movies')->group(function () {
        Route::get('{id}', [FrontendMovieController::class, 'show'])->name('web.movie.show');
    });

    Route::post('/recharge-card', [CardController::class, 'rechargeCard'])
        ->name('web.recharge_card');
    Route::get('/product-by-category', [WebController::class, 'getProductByCategory'])
        ->name('web.getDataAjax');
    Route::get('/product-detail/{id}', [WebController::class, 'showProduct'])
        ->name('web.product.show');
    Route::post('/product-purchase', [WebController::class, 'purchaseProduct'])
        ->name('web.purchase_product');
    Route::get('/nap-tien/{slug}', [WebController::class, 'getRecharge'])
        ->name('web.recharge');

    Route::prefix('customers')->group(function () {
        Route::get('/history', [FrontendCustomerController::class, 'history'])
            ->name('web.customers.history');
        Route::post('/markAsRead', [FrontendCustomerController::class, 'markAsRead'])
            ->name('web.customers.markAsRead');
    });
});
Route::get('/product/{slug}', [WebController::class, 'getProductBySlugCategory'])
    ->name('web.product_category');
Route::get('/editor', [WebController::class, 'exampleCkeditor'])
    ->name('web.editor');

// Forgot password
Route::get('/forgot-password', [FrontendLoginController::class, 'forgotPassword'])
    ->name('web.forgot_password');
Route::post('/send-mail/reset-password', [FrontendLoginController::class, 'sendMailResetPassword'])
    ->name('web.send_mail_reset_password');

Route::get('/reset-password', [FrontendLoginController::class, 'formResetPassword'])
    ->name('web.form_reset_password');

Route::post('/reset-password', [FrontendLoginController::class, 'storeResetPassword'])
    ->name('web.post_reset_password');
