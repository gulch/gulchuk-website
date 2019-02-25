<?php

/* Register Dotenv */
\Dotenv\Dotenv::create(__DIR__ . '/../..')->load();

/* Load Configuration */
\App\Helpers\Config::bootstrap(__DIR__ . '/../../config');

/* Dependency Injection Container */
$container = new \League\Container\Container;
require __DIR__ . '/dependencies.php';
\App\Helpers\Container::bootstrap($container);
