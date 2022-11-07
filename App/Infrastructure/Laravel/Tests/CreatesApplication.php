<?php

declare(strict_types=1);

namespace Tests;

use Behat\Behat\Tester\Exception\PendingException;
use Illuminate\Contracts\Console\Kernel;
use Laravel\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../Bootstrap/app.php';

        $app->make(abstract: Kernel::class)->bootstrap();

        return $app;
    }
}
