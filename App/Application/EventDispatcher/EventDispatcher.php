<?php

namespace App\Application\EventDispatcher;

use Illuminate\Contracts\Events\Dispatcher;

interface EventDispatcher extends Dispatcher
{
    public function flushMultiple(array $events): void;

    public function dispatchMultiple(array $events): void;
}
