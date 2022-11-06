<?php

declare(strict_types=1);

namespace Laravel\Events;

use App\Application\Events\EventDispatcher;
use Illuminate\Events\Dispatcher as IlluminateDispatcher;

final class Dispatcher extends IlluminateDispatcher implements EventDispatcher
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
}
