<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Extra Database Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define additional database connections that should be 
    | available for switching.
    |
    */
    'extra_connections' => [
        'dev' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false,
            // Like [database.connections.mysql]
        ],

        'master' => [
            'dev' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', 'localhost'),
            ],

            'dev.read' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', 'localhost'),
            ],
        ],
    ],
];
