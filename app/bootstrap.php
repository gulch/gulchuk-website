<?php

require __DIR__ . '/../vendor/autoload.php';

/* Register Dotenv */
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

/* Load Configuration */
$config = include(__DIR__ . '/config.php');

/* Dependency Injection container */
$container = include(__DIR__ . '/dependencies.php');

/* Boot Eloquent */
include(__DIR__ . '/db.php');

$request = $container->get('Request');
$response = $container->get('Response');

if ($config['debug']) {
    /* Register the error handler */
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

/* Init Router */
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include(__DIR__ . '/routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};
$routerDispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);
$routeInfo = $routerDispatcher->dispatch($request->getMethod(), $request->getPathInfo());

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $params = $routeInfo[2];
        call_user_func_array([$container->get($className), $method], $params);
        break;

    case FastRoute\Dispatcher::NOT_FOUND:
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setStatusCode(404);
        $response->setContent('Not Found!');
        break;
}

$response->send();
