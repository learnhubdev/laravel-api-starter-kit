<?php

declare(strict_types=1);

namespace Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\Clock\NativeClock;

class ClockServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(abstract: ClockInterface::class, concrete: NativeClock::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
