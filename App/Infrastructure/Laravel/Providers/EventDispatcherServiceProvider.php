<?php

namespace Laravel\Providers;

use App\Application\EventDispatcher\EventDispatcher;
use Illuminate\Contracts\Events\Dispatcher as IlluminateEventDispatcher;
use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Support\ServiceProvider;
use Laravel\Events\Dispatcher;

class EventDispatcherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(abstract: EventDispatcher::class, concrete: Dispatcher::class);
        $this->app->singleton(abstract: IlluminateEventDispatcher::class, concrete: Dispatcher::class);
        $this->app->singleton(abstract: 'events', concrete: function ($app) {
            return (new Dispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
