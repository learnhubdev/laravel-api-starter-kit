<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env(key: 'FILESYSTEM_DISK', default: 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path(path: 'app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path(path: 'app/public'),
            'url' => env(key: 'APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env(key: 'AWS_ACCESS_KEY_ID'),
            'secret' => env(key: 'AWS_SECRET_ACCESS_KEY'),
            'region' => env(key: 'AWS_DEFAULT_REGION'),
            'bucket' => env(key: 'AWS_BUCKET'),
            'url' => env(key: 'AWS_URL'),
            'endpoint' => env(key: 'AWS_ENDPOINT'),
            'use_path_style_endpoint' => env(key: 'AWS_USE_PATH_STYLE_ENDPOINT', default: false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path(path: 'storage') => storage_path(path: 'app/public'),
    ],

];
