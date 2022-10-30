<?php

return [
    /*
     *  Automatic registration of routes will only happen if this setting is `true`
     */
    'enabled' => true,

    /*
     * Controllers in these directories that have routing attributes
     * will automatically be registered.
     *
     * Optionally, you can specify group configuration by using key/values
     */
    'directories' => [
        base_path(path: 'App/Infrastructure/Members') => [
            'middleware' => 'api',
            'prefix' => 'api/v1',
            'namespace' => '\App\Infrastructure\Members',
        ],
    ],

    /**
     * This middleware will be applied to all routes.
     */
    'middleware' => [],
];
