<?php

declare(strict_types=1);

namespace Laravel\Providers;

use App\Application\Events\EventDispatcher;
use App\Application\Members\SendMemberActivationEmail;
use App\Domain\Members\MemberSignedUp;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Laravel\Events\Dispatcher;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        MemberSignedUp::class => [
            SendMemberActivationEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->singleton(abstract: EventDispatcher::class, concrete: Dispatcher::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
