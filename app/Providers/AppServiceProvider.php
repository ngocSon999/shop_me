<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
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
