<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Facade;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        Facade::defaultAliases()->collect();
    }
}
