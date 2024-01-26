<?php

/*
 * Route admin
 */

use App\Http\Controllers\Admin\ProductController;
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

Route::prefix('/admin')->middleware('sentinel.auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/user')->name('users.')->middleware('sentinel.auth')->group(function () {
        Route::get('/create', [UserController::class, 'createForm'])->name('form');
        Route::post('/store', [UserController::class, 'create'])->name('create');
        Route::get('/index', [UserController::class, 'index'])->name('index');
        Route::get('/list', [UserController::class, 'getList'])->name('list');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
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
});

