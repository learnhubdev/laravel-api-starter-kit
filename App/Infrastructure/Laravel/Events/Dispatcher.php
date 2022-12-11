<?php

declare(strict_types=1);

namespace Laravel\Events;

use App\Application\Events\EventDispatcher;
use Illuminate\Events\Dispatcher as IlluminateDispatcher;

final class Dispatcher extends IlluminateDispatcher implements EventDispatcher
{
    public function flushMultiple(array $events): void
    {
        foreach ($events as $event) {
            $this->flush(event: $event::class);
        }
    }

    public function dispatchMultiple(array $events, bool $halt = false): void
    {
        foreach ($events as $event) {
            $this->dispatch(event: $event::class, payload: get_class_vars($event::class), halt: $halt);
        }
    }
}
