<?php

namespace App\Providers;

use App\Http\Repositories\BaseRepoInterface;
use App\Http\Repositories\CategoryRepoInterface;
use App\Http\Repositories\CustomerRepoInterface;
use App\Http\Repositories\Impl\BaseRepository;
use App\Http\Repositories\Impl\CategoryRepository;
use App\Http\Repositories\Impl\CustomerRepository;
use App\Http\Repositories\Impl\MovieRepository;
use App\Http\Repositories\Impl\UserRepository;
use App\Http\Repositories\MovieRepoInterface;
use App\Http\Repositories\UserRepoInterface;
use App\Http\Services\BaseServiceInterface;
use App\Http\Services\CategoryServiceInterface;
use App\Http\Services\Impl\BaseService;
use App\Http\Services\Impl\CategoryService;
use App\Http\Services\MovieServiceInterface;
use App\Http\Services\Impl\MovieService;
use App\Http\Services\Impl\SaveTraceService;
use App\Http\Services\Impl\SentinelService;
use App\Http\Services\SaveTraceServiceInterface;
use App\Http\Services\SentinelServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        app()->bind(CategoryServiceInterface::class, CategoryService::class);
//        app()->bind(SentinelServiceInterface::class, SentinelService::class);
//        app()->bind(MovieServiceInterface::class, MovieService::class);
//        app()->bind(SaveTraceServiceInterface::class, SaveTraceService::class);
//        app()->bind(BaseServiceInterface::class, BaseService::class);
//
//        app()->bind(BaseRepoInterface::class, BaseRepository::class);
//        app()->bind(CategoryRepoInterface::class, CategoryRepository::class);
//        app()->bind(UserRepoInterface::class, UserRepository::class);
//        app()->bind(MovieRepoInterface::class, MovieRepository::class);
//        app()->bind(CustomerRepoInterface::class, CustomerRepository::class);
    }
}
