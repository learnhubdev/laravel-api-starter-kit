<?php

namespace App\Infrastructure\Laravel\Foundation;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Contracts\Foundation\CachesRoutes;
use Illuminate\Contracts\Foundation\MaintenanceMode as MaintenanceModeContract;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application as IlluminateApplication;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Foundation\Events\LocaleUpdated;
use Illuminate\Foundation\Mix;
use Illuminate\Foundation\PackageManifest;
use Illuminate\Http\Request;
use Illuminate\Log\LogServiceProvider;
use Illuminate\Routing\RoutingServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Env;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Application extends IlluminateApplication
{
    public function __construct(string $basePath = null)
    {
        parent::__construct();

        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
        $this->registerCoreContainerAliases();
    }

    /**
     * Bind all the application paths in the container.
     *
     * @return void
     */
    protected function bindPathsInContainer(): void
    {
        $this->instance('path', $this->path());
        $this->instance('path.base', $this->basePath());
        $this->instance('path.config', $this->configPath(path: 'App/Infrastructure/Laravel/Config'));
        $this->instance('path.public', $this->publicPath());
        $this->instance('path.storage', $this->storagePath(path: 'App/Infrastructure/Laravel/Storage'));
        $this->instance('path.database', $this->databasePath(path: 'App/Infrastructure/Laravel/Database'));
        $this->instance('path.resources', $this->resourcePath(path: 'App/Infrastructure/Laravel/Resources'));
        $this->instance('path.bootstrap', $this->bootstrapPath(path: 'App/Infrastructure/Laravel/Bootstrap'));
        $this->useStoragePath(path: dirname(path: __DIR__) . '/Storage');
        $this->useLangPath(path: value(value: function () {
            if (is_dir(filename: $directory = $this->resourcePath(path: 'Language'))) {
                return $directory;
            }

            return $this->basePath(path: 'App/Infrastructure/Laravel/Language');
        }));
    }

    /**
     * Get the path to the application configuration files.
     *
     * @param  string  $path
     * @return string
     */
    public function configPath($path = ''): string
    {
        return dirname(path: __DIR__) . '/Config'.($path != '' ? DIRECTORY_SEPARATOR.$path : '');
    }
}
