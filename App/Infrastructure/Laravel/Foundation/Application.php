<?php

declare(strict_types=1);

namespace Laravel\Foundation;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application as IlluminateApplication;

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
     */
    protected function bindPathsInContainer(): void
    {
        $this->instance(abstract: 'path', instance: $this->path('App/Infrastructure/Laravel/'));
        $this->instance(abstract: 'path.base', instance: $this->basePath());
        $this->instance(abstract: 'path.config', instance: $this->configPath(path: 'App/Infrastructure/Laravel/Config'));
        $this->instance(abstract: 'path.public', instance: $this->publicPath());
        $this->instance(abstract: 'path.storage', instance: $this->storagePath(path: 'App/Infrastructure/Laravel/Storage'));
        $this->instance(abstract: 'path.database', instance: $this->databasePath(path: 'App/Infrastructure/Laravel/Database'));
        $this->instance(abstract: 'path.resources', instance: $this->resourcePath(path: 'App/Infrastructure/Laravel/Resources'));
        $this->instance(abstract: 'path.bootstrap', instance: $this->bootstrapPath(path: 'App/Infrastructure/Laravel/Bootstrap'));
        $this->useDatabasePath(path: dirname(path: __DIR__).'/Database');
        $this->useAppPath(path: dirname(path: __DIR__));
        $this->useStoragePath(path: dirname(path: __DIR__).'/Storage');
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
     */
    public function configPath($path = ''): string
    {
        return dirname(path: __DIR__).'/Config'.($path != '' ? DIRECTORY_SEPARATOR.$path : '');
    }
}
