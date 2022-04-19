<?php
/**
 * Database Configuration
 *
 * Heroku exposes a "connection string" that contains everything we need. First-party Postgres databases add this under the `DATABASE_URL` variable!
 */

use craft\helpers\App;

return [
    '*' => [
        'driver' => App::env('DB_DRIVER'),
        'server' => App::env('DB_SERVER'),
        'user' => App::env('DB_USER'),
        'password' => App::env('DB_PASSWORD'),
        'database' => App::env('DB_DATABASE'),
        'schema' => App::env('DB_SCHEMA'),
        'tablePrefix' => App::env('DB_TABLE_PREFIX'),
        'port' => App::env('DB_PORT'),
    ],
    'production' => [
        'url' => App::env('DATABASE_URL'),
    ],
];
