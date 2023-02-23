<?php

namespace App\Application\Events;

use Illuminate\Contracts\Events\Dispatcher;

interface EventDispatcher extends Dispatcher
{
    public function flushMultiple(array $events): void;

    public function dispatchMultiple(array $events, bool $halt = false): void;
}
