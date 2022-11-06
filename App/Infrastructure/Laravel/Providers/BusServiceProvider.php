<?php

declare(strict_types=1);

namespace Laravel\Providers;

use App\Application\Members\SignUpMember;
use App\Application\Members\SignUpMemberCommandHandler;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Bus;

final class BusServiceProvider extends ServiceProvider
{
    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        Bus::map([
            SignUpMember::class => SignUpMemberCommandHandler::class,
        ]);
    }
}
