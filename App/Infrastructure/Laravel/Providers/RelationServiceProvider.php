<?php

declare(strict_types=1);

namespace Laravel\Providers;

use App\Infrastructure\Authentication\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class RelationServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'user' => User::class,
        ]);
    }
}
