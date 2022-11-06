<?php

namespace App\Application\Events;

use Illuminate\Contracts\Events\Dispatcher;

interface EventDispatcher extends Dispatcher
{
    public function flushAll(array $events);
}
