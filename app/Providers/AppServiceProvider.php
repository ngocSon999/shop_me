<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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

        $notifyPage = [];
        $categories = [];

        if (Schema::hasTable('settings')) {
            if (getSetting('notify_page_title')) {
                $notifyPage['title'] = getSetting('notify_page_title');
            }
            if (getSetting('notify_page_content')) {
                $notifyPage['content'] = getSetting('notify_page_content');
            }
        }
        if (Schema::hasTable('categories')) {
            $categories = Category::all();
        }

        View::share('notifyPage', $notifyPage);
        View::share('categories', $categories);
    }
}
