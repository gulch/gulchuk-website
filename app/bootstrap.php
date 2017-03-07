<?php

require __DIR__ . '/../vendor/autoload.php';

/* Register Dotenv */
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

/* Load Configuration */
$config = include(__DIR__ . '/config.php');
Config::getInstance()->setConfig($config);

if ($config['debug']) {
    error_reporting(E_ALL);
    /* Register the error handler */
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

/* Dependency Injection container */
/**
 * @var $container \League\Container\Container
 */
$container = include(__DIR__ . '/dependencies.php');
Container::create($container);

/* Boot Eloquent ORM */
include(__DIR__ . '/db.php');

$request = $container->get('request');
$response = $container->get('response');

/* Router & Routes */
/**
 * @var $router \League\Route\RouteCollection
 */
$router = new \League\Route\RouteCollection($container);
include(__DIR__ . '/routes.php');

try {
    $response = $router->dispatch($request, $response);
} catch (\League\Route\Http\Exception\NotFoundException $e) {
    $response->getBody()->write($container->get('templater')->render('errors/404'));
    $response = $response->withStatus(404);
} /*catch (\Exception $e) {
    $response->getBody()->write($container->get('templater')->render('errors/500'));
    $response = $response->withStatus(500);
}*/

$container->get('emitter')->emit($response);