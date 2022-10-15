<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Providers;

use App\Infrastructure\Laravel\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class RelationServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'user' => User::class,
        ]);
    }
}
