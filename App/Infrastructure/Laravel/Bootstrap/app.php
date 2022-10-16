<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

use Laravel\Console\Kernel as ConsoleKernel;
use Laravel\Exceptions\Handler;
use Laravel\Foundation\Application;
use Laravel\Http\Kernel as HttpKernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;

$app = new Application(
    basePath: dirname(path: __DIR__, levels: 4)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    abstract: HttpKernelContract::class,
    concrete: HttpKernel::class
);

$app->singleton(
    abstract: ConsoleKernelContract::class,
    concrete: ConsoleKernel::class
);

$app->singleton(
    abstract: ExceptionHandler::class,
    concrete: Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
