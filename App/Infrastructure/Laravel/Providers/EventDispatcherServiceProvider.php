<?php

namespace Laravel\Providers;

use App\Application\EventDispatcher\EventDispatcher;
use App\Application\Members\SendMemberActivationEmail;
use App\Domain\Members\MemberSignedUp;
use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Illuminate\Foundation\Events\DiscoverEvents;
use Illuminate\Support\ServiceProvider;
use Laravel\Events\Dispatcher;

final class EventDispatcherServiceProvider extends ServiceProvider
{
    private array $listen = [
        MemberSignedUp::class => [
            SendMemberActivationEmail::class,
        ],
    ];

    private array $subscribe = [];

    private array $observers = [];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(abstract: EventDispatcher::class, concrete: function ($app) {
            return (new Dispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });

        $this->app->singleton(abstract: 'events', concrete: function ($app) {
            return (new Dispatcher($app))->setQueueResolver(resolver: function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });

        $this->booting(function () {
            $events = $this->getEvents();

            $eventDispatcher = $this->app->make(abstract: EventDispatcher::class);

            foreach ($events as $event => $listeners) {
                foreach (array_unique($listeners, SORT_REGULAR) as $listener) {
                    $eventDispatcher->listen($event, $listener);
                }
            }

            foreach ($this->subscribe as $subscriber) {
                $eventDispatcher->subscribe($subscriber);
            }

            foreach ($this->observers as $model => $observers) {
                $model::observe($observers);
            }
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Get the events and handlers.
     */
    private function listens(): array
    {
        return $this->listen;
    }

    /**
     * Get the discovered events and listeners for the application.
     */
    private function getEvents(): array
    {
        if ($this->app->eventsAreCached()) {
            $cache = require $this->app->getCachedEventsPath();

            return $cache[get_class($this)] ?? [];
        } else {
            return $this->listens();
        }

    }

    /**
     * Discover the events and listeners for the application.
     */
    private function discoverEvents(): array
    {
        return collect($this->discoverEventsWithin())
            ->reject(function ($directory) {
                return ! is_dir($directory);
            })
            ->reduce(function ($discovered, $directory) {
                return array_merge_recursive(
                    $discovered,
                    DiscoverEvents::within($directory, $this->eventDiscoveryBasePath())
                );
            }, []);
    }

    /**
     * Get the listener directories that should be used to discover events.
     */
    protected function discoverEventsWithin(): array
    {
        return [
            this->eventDiscoveryBasePath(),
        ];
    }

    /**
     * Get the base path to be used during event discovery.
     */
    protected function eventDiscoveryBasePath(): string
    {
        return base_path();
    }
}
