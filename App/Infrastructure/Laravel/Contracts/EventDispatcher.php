<?php

namespace App\Infrastructure\Laravel\Contracts;

use Illuminate\Contracts\Events\Dispatcher;

interface EventDispatcher extends Dispatcher
{
    public function flushAll(array $events);
}
