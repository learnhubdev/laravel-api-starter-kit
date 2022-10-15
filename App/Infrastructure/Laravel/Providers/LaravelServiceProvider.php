<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->configPath(path: 'App/Infrastructure/Laravel/Config');
        $this->app->storagePath(path: 'App/Infrastructure/Laravel/Storage');
        $this->app->bootstrapPath(path: 'App/Infrastructure/Laravel/Bootstrap');
        $this->app->databasePath(path: 'App/Infrastructure/Laravel/Database');
        $this->app->resourcePath(path: 'App/Infrastructure/Laravel/Resources');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
