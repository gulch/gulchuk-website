<?php

return [
    'driver'      => env('DB_DRIVER', 'mysql'),
    'host'        => env('DB_HOST', 'localhost'),
    'unix_socket' => env('DB_SOCKET', '/var/run/mysqld/mysqld.sock'),
    'database'    => env('DB_DATABASE'),
    'username'    => env('DB_USER'),
    'password'    => env('DB_PASS'),
    'charset'     => 'utf8mb4',
    'collation'   => 'utf8mb4_0900_ai_ci',
    'prefix'      => '',
    'strict'      => false,
];
