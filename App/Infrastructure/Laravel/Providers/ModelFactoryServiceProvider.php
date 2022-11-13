<?php

namespace Laravel\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ModelFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            $namespace = 'Laravel\\Database\\Factories\\';
            $modelName = Str::afterLast($modelName, '\\');

            return $namespace.$modelName.'Factory';
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
