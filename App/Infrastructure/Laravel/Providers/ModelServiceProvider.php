<?php

declare(strict_types=1);

namespace Laravel\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Model::unguard();
        Model::shouldBeStrict(shouldBeStrict: ! $this->app->isProduction());
    }
}
