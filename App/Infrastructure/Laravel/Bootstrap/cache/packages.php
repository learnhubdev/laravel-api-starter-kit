<?php

return [
    'barryvdh/laravel-ide-helper' => [
        'providers' => [
            0 => 'Barryvdh\\LaravelIdeHelper\\IdeHelperServiceProvider',
        ],
    ],
    'laravel/sail' => [
        'providers' => [
            0 => 'Laravel\\Sail\\SailServiceProvider',
        ],
    ],
    'laravel/sanctum' => [
        'providers' => [
            0 => 'Laravel\\Sanctum\\SanctumServiceProvider',
        ],
    ],
    'laravel/tinker' => [
        'providers' => [
            0 => 'Laravel\\Tinker\\TinkerServiceProvider',
        ],
    ],
    'mattkingshott/snowflake' => [
        'providers' => [
            0 => 'Snowflake\\ServiceProvider',
        ],
    ],
    'mortexa/laravel-arkitect' => [
        'providers' => [
            0 => 'Mortexa\\LaravelArkitect\\ArkitectServiceProvider',
        ],
    ],
    'nesbot/carbon' => [
        'providers' => [
            0 => 'Carbon\\Laravel\\ServiceProvider',
        ],
    ],
    'nunomaduro/collision' => [
        'providers' => [
            0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
        ],
    ],
    'nunomaduro/laravel-pot' => [
        'providers' => [
            0 => 'NunoMaduro\\LaravelPot\\PotServiceProvider',
        ],
    ],
    'nunomaduro/termwind' => [
        'providers' => [
            0 => 'Termwind\\Laravel\\TermwindServiceProvider',
        ],
    ],
    'spatie/laravel-ignition' => [
        'providers' => [
            0 => 'Spatie\\LaravelIgnition\\IgnitionServiceProvider',
        ],
        'aliases' => [
            'Flare' => 'Spatie\\LaravelIgnition\\Facades\\Flare',
        ],
    ],
    'spatie/laravel-route-attributes' => [
        'providers' => [
            0 => 'Spatie\\RouteAttributes\\RouteAttributesServiceProvider',
        ],
    ],
];
