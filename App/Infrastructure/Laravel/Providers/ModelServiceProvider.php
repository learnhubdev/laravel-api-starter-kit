<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::unguard();
        Model::shouldBeStrict(shouldBeStrict: ! $this->app->isProduction());

    }
}
