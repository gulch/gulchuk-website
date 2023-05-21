<?php

/* Register Dotenv */
\Dotenv\Dotenv::create(\App\Helpers\Env::getRepository(), __DIR__ . '/../..',)->safeLoad();

/* Load Configuration */
\App\Helpers\Config::bootstrap(__DIR__ . '/../../config');

/* Dependency Injection Container */
$container = new \League\Container\Container;
require __DIR__ . '/dependencies.php';
\App\Helpers\Container::bootstrap($container);
