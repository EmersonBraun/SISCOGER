<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => 'sjd',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sjd' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        'sjd2' => [
            'driver' => 'mysql',
            'host' => '10.22.9.210',
            'port' => '3306',
            'database' => 'sjd',
            'username' => env('DB_USERNAME_SJD2', 'forge'),
            'password' => env('DB_PASSWORD_SJD2', ''),
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'rhparana' => [
            'driver' => 'sqlsrv',
            'host' => '10.47.1.4',
            'port' => env('DB_PORT_RHPARANA', '1433'),
            'database' => env('DB_DATABASE_RHPARANA', 'forge'),
            'username' => env('DB_USERNAME_RHPARANA', 'forge'),
            'password' => env('DB_PASSWORD_RHPARANA', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

        'rhparana2' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_RHPARANA2', '127.0.0.1'),
            'port' => env('DB_PORT_RHPARANA2', '3306'),
            'database' => 'RHPARANA',
            'username' => env('DB_USERNAME_RHPARANA2', 'forge'),
            'password' => env('DB_PASSWORD_RHPARANA2', ''),
            'unix_socket' => env('DB_SOCKET_RHPARANA2', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
        ],

        'meta4' => [
            'driver' => 'sqlsrv',
            'host' => '10.47.1.4',
            'port' => env('DB_PORT_META4', '1433'),
            'database' => env('DB_DATABASE_META4', 'forge'),
            'username' => env('DB_USERNAME_META4', 'forge'),
            'password' => env('DB_PASSWORD_META4', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

        'pass' => [
            'driver' => 'sqlsrv',
            'host' => '10.47.1.3',
            'port' => env('DB_PORT_PASS', '1433'),
            'database' => env('DB_DATABASE_PASS', 'forge'),
            'username' => env('DB_USERNAME_PASS', 'forge'),
            'password' => env('DB_PASSWORD_PASS', ''),
            'charset' => 'utf8',
            'prefix' => '',
        ],

        'redis' => [

            'client' => 'predis',
        
            'default' => [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
                'database' => 0,
            ],
        
        ],

            'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
