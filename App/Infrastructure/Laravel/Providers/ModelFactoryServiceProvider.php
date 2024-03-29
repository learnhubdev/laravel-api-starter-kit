<?php

namespace Laravel\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;

class ModelFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Factory::guessFactoryNamesUsing(fn(string $modelName) => $modelName.'Factory');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
