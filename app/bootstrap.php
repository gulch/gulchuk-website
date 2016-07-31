<?php

require __DIR__ . '/../vendor/autoload.php';

/* Register Dotenv */
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

/* Load Configuration */
$config = include(__DIR__ . '/config.php');

if ($config['debug']) {
    /* Register the error handler */
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

/* Dependency Injection container */
$container = include(__DIR__ . '/dependencies.php');

/* Boot Eloquent ORM */
include(__DIR__ . '/db.php');

$request = $container->get('Psr\Http\Message\ServerRequestInterface');
$response = $container->get('Psr\Http\Message\ResponseInterface');

/* Router & Routes */
$route = new League\Route\RouteCollection($container);
include(__DIR__ . '/routes.php');

$response = $route->dispatch($request, $response);

$container->get('emitter')->emit($response);
