<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env(key: 'LOG_CHANNEL', default: 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env(key: 'LOG_DEPRECATIONS_CHANNEL', default: 'null'),
        'trace' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path(path: 'logs/laravel.log'),
            'level' => env(key: 'LOG_LEVEL', default: 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path(path: 'logs/laravel.log'),
            'level' => env(key: 'LOG_LEVEL', default: 'debug'),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env(key: 'LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env(key: 'LOG_LEVEL', default: 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env(key: 'LOG_LEVEL', default: 'debug'),
            'handler' => env(key: 'LOG_PAPERTRAIL_HANDLER', default: SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env(key: 'PAPERTRAIL_URL'),
                'port' => env(key: 'PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env(key: 'PAPERTRAIL_URL').':'.env(key: 'PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env(key: 'LOG_LEVEL', default: 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env(key: 'LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env(key: 'LOG_LEVEL', default: 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env(key: 'LOG_LEVEL', default: 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path(path: 'logs/laravel.log'),
        ],
    ],

];
