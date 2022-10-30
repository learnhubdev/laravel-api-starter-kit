<?php
// @formatter:off
// phpcs:ignoreFile

/**
 * A helper file for Laravel, to provide autocomplete information to your IDE
 * Generated for Laravel 9.37.0.
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */

namespace Spatie\LaravelIgnition\Facades {

    use Spatie\FlareClient\array;
    use Spatie\FlareClient\classuse Spatie\FlareClient\FlareMiddleware\FlareMiddleware;

    /**
     *
     *
     * @see \Spatie\FlareClient\Flare
     */
    class Flare
    {
        /**
         *
         *
         * @static
         */
        public static function make($apiKey = null, $contextDetector = null)
        {
            return \Spatie\FlareClient\Flare::make($apiKey, $contextDetector);
        }

        /**
         *
         *
         * @static
         */
        public static function setApiToken($apiToken)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->setApiToken($apiToken);
        }

        /**
         *
         *
         * @static
         */
        public static function apiTokenSet()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->apiTokenSet();
        }

        /**
         *
         *
         * @static
         */
        public static function setBaseUrl($baseUrl)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->setBaseUrl($baseUrl);
        }

        /**
         *
         *
         * @static
         */
        public static function setStage($stage)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->setStage($stage);
        }

        /**
         *
         *
         * @static
         */
        public static function sendReportsImmediately()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->sendReportsImmediately();
        }

        /**
         *
         *
         * @static
         */
        public static function determineVersionUsing($determineVersionCallable)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->determineVersionUsing($determineVersionCallable);
        }

        /**
         *
         *
         * @static
         */
        public static function reportErrorLevels($reportErrorLevels)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->reportErrorLevels($reportErrorLevels);
        }

        /**
         *
         *
         * @static
         */
        public static function filterExceptionsUsing($filterExceptionsCallable)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->filterExceptionsUsing($filterExceptionsCallable);
        }

        /**
         *
         *
         * @static
         */
        public static function filterReportsUsing($filterReportsCallable)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->filterReportsUsing($filterReportsCallable);
        }

        /**
         *
         *
         * @static
         */
        public static function version()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->version();
        }

        /**
         *
         *
         * @return array<int, FlareMiddleware|class-string<FlareMiddleware>>
         * @static
         */
        public static function getMiddleware()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->getMiddleware();
        }

        /**
         *
         *
         * @static
         */
        public static function setContextProviderDetector($contextDetector)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->setContextProviderDetector($contextDetector);
        }

        /**
         *
         *
         * @static
         */
        public static function setContainer($container)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->setContainer($container);
        }

        /**
         *
         *
         * @static
         */
        public static function registerFlareHandlers()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->registerFlareHandlers();
        }

        /**
         *
         *
         * @static
         */
        public static function registerExceptionHandler()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->registerExceptionHandler();
        }

        /**
         *
         *
         * @static
         */
        public static function registerErrorHandler()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->registerErrorHandler();
        }

        /**
         *
         *
         * @param  FlareMiddleware|array<FlareMiddleware>|class-string<FlareMiddleware>  $middleware
         * @return \Spatie\FlareClient\Flare
         * @static
         */
        public static function registerMiddleware($middleware)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->registerMiddleware($middleware);
        }

        /**
         *
         *
         * @return array<int,FlareMiddleware|class-string<FlareMiddleware>>
         * @static
         */
        public static function getMiddlewares()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->getMiddlewares();
        }

        /**
         *
         *
         * @param  string  $name
         * @param  string  $messageLevel
         * @param  array<int,  mixed>  $metaData
         * @return \Spatie\FlareClient\Flare
         * @static
         */
        public static function glow($name, $messageLevel = 'info', $metaData = [])
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->glow($name, $messageLevel, $metaData);
        }

        /**
         *
         *
         * @static
         */
        public static function handleException($throwable)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->handleException($throwable);
        }

        /**
         *
         *
         * @return mixed
         * @static
         */
        public static function handleError($code, $message, $file = '', $line = 0)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->handleError($code, $message, $file, $line);
        }

        /**
         *
         *
         * @static
         */
        public static function applicationPath($applicationPath)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->applicationPath($applicationPath);
        }

        /**
         *
         *
         * @static
         */
        public static function report($throwable, $callback = null, $report = null)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->report($throwable, $callback, $report);
        }

        /**
         *
         *
         * @static
         */
        public static function reportMessage($message, $logLevel, $callback = null)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->reportMessage($message, $logLevel, $callback);
        }

        /**
         *
         *
         * @static
         */
        public static function sendTestReport($throwable)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->sendTestReport($throwable);
        }

        /**
         *
         *
         * @static
         */
        public static function reset()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->reset();
        }

        /**
         *
         *
         * @static
         */
        public static function anonymizeIp()
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->anonymizeIp();
        }

        /**
         *
         *
         * @param  array<int,  string>  $fieldNames
         * @return \Spatie\FlareClient\Flare
         * @static
         */
        public static function censorRequestBodyFields($fieldNames)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->censorRequestBodyFields($fieldNames);
        }

        /**
         *
         *
         * @static
         */
        public static function createReport($throwable)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->createReport($throwable);
        }

        /**
         *
         *
         * @static
         */
        public static function createReportFromMessage($message, $logLevel)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->createReportFromMessage($message, $logLevel);
        }

        /**
         *
         *
         * @static
         */
        public static function stage($stage)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->stage($stage);
        }

        /**
         *
         *
         * @static
         */
        public static function messageLevel($messageLevel)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->messageLevel($messageLevel);
        }

        /**
         *
         *
         * @param  string  $groupName
         * @param  mixed  $default
         * @return array<int, mixed>
         * @static
         */
        public static function getGroup($groupName = 'context', $default = [])
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->getGroup($groupName, $default);
        }

        /**
         *
         *
         * @static
         */
        public static function context($key, $value)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->context($key, $value);
        }

        /**
         *
         *
         * @param  string  $groupName
         * @param  array<string,  mixed>  $properties
         * @return \Spatie\FlareClient\Flare
         * @static
         */
        public static function group($groupName, $properties)
        {
            /** @var \Spatie\FlareClient\Flare $instance */
            return $instance->group($groupName, $properties);
        }

    }
}

namespace Illuminate\Http {

    /**
     *
     *
     */
    class Request
    {
        /**
         *
         *
         * @param  array  $rules
         * @param  mixed  $params
         * @static
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestValidation()
         */
        public static function validate($rules, ...$params)
        {
            return Request::validate($rules, ...$params);
        }

        /**
         *
         *
         * @param  string  $errorBag
         * @param  array  $rules
         * @param  mixed  $params
         * @static
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestValidation()
         */
        public static function validateWithBag($errorBag, $rules, ...$params)
        {
            return Request::validateWithBag($errorBag, $rules, ...$params);
        }

        /**
         *
         *
         * @param  mixed  $absolute
         * @static
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         */
        public static function hasValidSignature($absolute = true)
        {
            return Request::hasValidSignature($absolute);
        }

        /**
         *
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @static
         */
        public static function hasValidRelativeSignature()
        {
            return Request::hasValidRelativeSignature();
        }

        /**
         *
         *
         * @param  mixed  $ignoreQuery
         * @param  mixed  $absolute
         * @static
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         */
        public static function hasValidSignatureWhileIgnoring($ignoreQuery = [], $absolute = true)
        {
            return Request::hasValidSignatureWhileIgnoring($ignoreQuery, $absolute);
        }

    }
}

namespace Illuminate\Database\Schema {

    /**
     *
     *
     */
    class Blueprint
    {
        /**
         *
         *
         * @param  mixed  $column
         * @static
         * @see \Snowflake\ServiceProvider::macros()
         */
        public static function snowflake($column = 'id')
        {
            return Blueprint::snowflake($column);
        }

        /**
         *
         *
         * @param  mixed  $column
         * @static
         * @see \Snowflake\ServiceProvider::macros()
         */
        public static function foreignSnowflake($column)
        {
            return Blueprint::foreignSnowflake($column);
        }

        /**
         *
         *
         * @param  mixed  $model
         * @param  mixed  $column
         * @static
         * @see \Snowflake\ServiceProvider::macros()
         */
        public static function foreignSnowflakeFor($model, $column = null)
        {
            return Blueprint::foreignSnowflakeFor($model, $column);
        }

    }
}


namespace {

    class Flare extends \Spatie\LaravelIgnition\Facades\Flare
    {
    }
}




