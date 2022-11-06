<?php

declare(strict_types=1);

namespace App\Infrastructure\Laravel\Events;

use App\Infrastructure\Laravel\Contracts\EventDispatcher;
use Illuminate\Events\Dispatcher as IlluminateDispatcher;

final class Dispatcher extends IlluminateDispatcher implements EventDispatcher
{
    /**
     * @param  array  $events
     *
     * @return void
     */
    public function flushAll(array $events): void
    {
        /** @var Dispatcher $event */
        foreach($events as $event) {
            $this->flush(event: $event::class);
        }
    }
}
