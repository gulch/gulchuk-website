<?php

require __DIR__ . '/../vendor/autoload.php';

/* Register Dotenv */
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

/* Load Configuration */
$config = include(__DIR__ . '/config.php');
Config::getInstance()->setConfig($config);

if ($config['debug']) {
    error_reporting(E_ERROR);
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

/** @var \Psr\Http\Message\RequestInterface $request */
$request = $container->get('request');
/** @var \Psr\Http\Message\ResponseInterface $response */
$response = $container->get('response');

/* Router & Routes */
$router = new \League\Route\RouteCollection($container);
include(__DIR__ . '/routes.php');

try {

    $response = $router->dispatch($request, $response);

} catch (\League\Route\Http\Exception\NotFoundException $e) {

    $response->getBody()->write($container->get('templater')->render('errors/404'));
    $response = $response->withStatus(404);

} catch (\Exception $e) {

    if ($config['debug']) {
        $whoops->handleException($e);
    } else {
        $response->getBody()->write($container->get('templater')->render('errors/500'));
        $response = $response->withStatus(500);
    }

}

// send/flush response
$container->get('emitter')->emit($response);

/*if (function_exists('fastcgi_finish_request')) {
    fastcgi_finish_request();
}

foreach ($router->getMiddlewareStack() as $middleware) {
    if (method_exists($middleware, 'terminate')) {
        $middleware->terminate($request, $response);
    }
}*/