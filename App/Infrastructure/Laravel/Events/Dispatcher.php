<?php

declare(strict_types=1);

namespace Laravel\Events;

use App\Application\EventDispatcher\EventDispatcher;
use Illuminate\Events\Dispatcher as IlluminateDispatcher;

final class Dispatcher extends IlluminateDispatcher implements EventDispatcher
{
    public function flushMultiple(array $events): void
    {
        foreach ($events as $event) {
            $this->flush(event: $event::class);
        }
    }

    public function dispatchMultiple(array $events): void
    {
        foreach ($events as $event) {
            $this->dispatch(event: $event, payload: get_object_vars($event));
        }
    }
}
