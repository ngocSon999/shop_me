<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $path = app_path('/Http/Repositories');
        $pathService = app_path('/Http/Services');

        $repositories = array_diff(scandir($path), array('.', '..', 'Impl'));
        $repoServices = array_diff(scandir($pathService), array('.', '..', 'Impl'));

        if (!$repositories) {
            return;
        }

        foreach ($repositories as $repository) {
            $this->app->bind(
                'App\Http\Repositories\\' . str_replace('.php', '', $repository),
                'App\Http\Repositories\\Impl\\' . str_replace('RepoInterface.php', 'Repository', $repository),
            );
        }

        foreach ($repoServices as $repositoryService) {
            $this->app->bind(
                'App\Http\Services\\' . str_replace('.php', '', $repositoryService),
                'App\Http\Services\\Impl\\' . str_replace('Interface.php', '', $repositoryService),
            );
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
