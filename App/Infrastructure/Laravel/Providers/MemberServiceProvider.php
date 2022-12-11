<?php

declare(strict_types=1);

namespace Laravel\Providers;

use App\Domain\Members\MemberRepository;
use App\Infrastructure\Members\EloquentMemberRepository;
use Illuminate\Support\ServiceProvider;

final class MemberServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(abstract: MemberRepository::class, concrete: EloquentMemberRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
