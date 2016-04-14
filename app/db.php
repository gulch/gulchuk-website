<?php

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection(
    [
        'driver' => env('DB_DRIVER','mysql'),
        'host' => env('DB_HOST', 'localhost'),
        'database' => env('DB_NAME'),
        'username' => env('DB_USER'),
        'password' => env('DB_PASS'),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    ]
);
$capsule->setAsGlobal();
$capsule->bootEloquent();