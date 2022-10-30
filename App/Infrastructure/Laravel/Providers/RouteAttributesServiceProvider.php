<?php

namespace Laravel\Providers;

use Spatie\RouteAttributes\RouteAttributesServiceProvider as SpatieRouteAttributesServiceProvider;

class RouteAttributesServiceProvider extends SpatieRouteAttributesServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(path: config_path(path: 'route-attributes.php'), key: 'route-attributes');
    }
}
