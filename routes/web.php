<?php

/*
 * Route admin
 */

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
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
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.user.logout');
Route::post('/admin/user/postLogin', [LoginController::class, 'postLogin'])->name('admin.user.post-login');

Route::middleware('checkPermission:dashboard.index')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('checkPermission:dashboard.index')->name('dashboard');

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
            ->name('form');

        Route::post('/store', [BannerController::class, 'store'])
            ->name('store');

        Route::get('/index', [BannerController::class, 'index'])
            ->middleware('checkPermission:users.list')
            ->name('index');

        Route::get('/list', [BannerController::class, 'getList'])
            ->name('list');

        Route::get('/edit/{id}', [BannerController::class, 'edit'])
            ->name('edit');

        Route::put('/update/{id}', [BannerController::class, 'update'])
            ->name('update');

        Route::get('/delete/{id}', [BannerController::class, 'delete'])
            ->name('delete');
    });

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/create', [CategoryController::class, 'createForm'])->name('form');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/index', [CategoryController::class, 'index'])->name('index');
        Route::get('/list', [CategoryController::class, 'getList'])->name('list');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('/products')->name('products.')->group(function () {
        Route::get('/create', [ProductController::class, 'createForm'])->name('form');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/index', [ProductController::class, 'index'])->name('index');
        Route::get('/list', [ProductController::class, 'getList'])->name('list');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
    });

    Route::prefix('/roles')->name('roles.')->group(function () {
        Route::get('/create', [RoleController::class, 'createForm'])
            ->name('form');

        Route::post('/store', [RoleController::class, 'store'])
            ->name('store');

        Route::get('/index', [RoleController::class, 'index'])
            ->middleware('checkPermission:users.list')
            ->name('index');

        Route::get('/list', [RoleController::class, 'getList'])
            ->name('list');

        Route::get('/edit/{id}', [RoleController::class, 'edit'])
            ->name('edit');

        Route::put('/update/{id}', [RoleController::class, 'update'])
            ->name('update');

        Route::get('/delete/{id}', [RoleController::class, 'delete'])
            ->name('delete');
    });

    Route::prefix('/customers')->name('customers.')->group(function () {
        Route::get('/create', [CustomerController::class, 'createForm'])
            ->name('form');

        Route::get('/index', [CustomerController::class, 'index'])
            ->middleware('checkPermission:users.list')
            ->name('index');

        Route::get('/list', [CustomerController::class, 'getList'])
            ->name('list');

        Route::get('/show/{id}', [CustomerController::class, 'show'])
            ->name('show');

        Route::get('/add-coin/{id}', [CustomerController::class, 'editCoin'])
            ->name('edit_coin');

        Route::put('/update/{id}', [CustomerController::class, 'update'])
            ->name('update');

        Route::patch('/update/{id}', [CustomerController::class, 'addCoin'])
            ->name('add_coin');

        Route::get('/delete/{id}', [CustomerController::class, 'delete'])
            ->name('delete');

        Route::get('/transaction-history/{id}', [CustomerController::class, 'transactionHistory'])
            ->name('transaction_history');

        Route::post('/change-password', [CustomerController::class, 'updatePassword'])
            ->name('change_password');
    });
});

/*
 * register route web
 */
Route::get('', [WebController::class, 'index'])->name('web.index');
Route::get('/login', [FrontendLoginController::class, 'index'])->name('web.login');
Route::post('/login', [FrontendLoginController::class, 'login'])->name('web.login.store');


Route::prefix('customers')->group(function () {
    Route::get('/create', [FrontendCustomerController::class, 'createForm'])->name('web.customers.form');
    Route::post('/register', [FrontendCustomerController::class, 'store'])->name('web.customers.register');
});

Route::middleware('auth:customers')->group(function () {
    Route::get('/logout', [FrontendLoginController::class, 'logout'])->name('web.logout');
    Route::prefix('movies')->group(function () {
        Route::get('{id}', [FrontendMovieController::class, 'show'])->name('web.movie.show');
    });

    Route::get('/product-by-category', [WebController::class, 'getProductByCategory'])->name('web.getDataAjax');
    Route::get('/product-detail/{id}', [WebController::class, 'showProduct'])->name('web.product.show');
    Route::post('/product-purchase', [WebController::class, 'purchaseProduct'])->name('web.purchase_product');
    Route::get('/nap-tien/{slug}', [WebController::class, 'getRecharge'])->name('web.recharge');
});
Route::get('/product/{slug}', [WebController::class, 'getProductBySlugCategory'])->name('web.product_category');

