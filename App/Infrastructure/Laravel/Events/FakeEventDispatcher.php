<?php

declare(strict_types=1);

namespace Laravel\Events;

use App\Application\Events\EventDispatcher;
use Illuminate\Support\Testing\Fakes\EventFake as IlluminateEventFake;

final class FakeEventDispatcher extends IlluminateEventFake implements EventDispatcher
{
    /**
     * @param  array  $events
     * @return void
     */
    public function flushAll(array $events): void
    {
        /** @var Dispatcher $event */
        foreach ($events as $event) {
            $this->flush(event: $event::class);
        }
    }

    /**
     * @param  array  $events
     * @return void
     */
    public function dispatchAll(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch($event::class, get_class_vars($event::class));
        }
    }
}
