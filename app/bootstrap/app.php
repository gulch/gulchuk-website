<?php

define('APP_START', microtime(true));

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require __DIR__ . '/../../vendor/autoload.php';

/* Register Dotenv */
(new \Dotenv\Dotenv(__DIR__ . '/../..'))->load();

/* Load Configuration */
\App\Helpers\Config::bootstrap(__DIR__ . '/../../config');

/* Register Logger */
$logger = new \Monolog\Logger(config('app.name'), [
    new \Monolog\Handler\StreamHandler(__DIR__ . '/../../storage/logs/' . date('Ymd') . '.log'),
]);

/* Register Error Handler */
$errorHandler = new \Whoops\Run;

if (config('app.debug')) {
    $errorHandler->pushHandler(
        new \Whoops\Handler\PrettyPageHandler
    );
} else {
    $plainHandler = new \Whoops\Handler\PlainTextHandler($logger);
    $plainHandler->loggerOnly(true);
    $errorHandler->pushHandler($plainHandler);
}
$errorHandler->register();

/* Dependency Injection container */
/**
 * @var $container \League\Container\Container
 */
$container = require __DIR__ . '/dependencies.php';
\App\Helpers\Container::bootstrap($container);

/* Boot Eloquent ORM */
require __DIR__ . '/db.php';

/* Router & Routes */
$router = new \League\Route\RouteCollection($container);
require __DIR__ . '/../routes.php';

/** @var \Psr\Http\Message\RequestInterface */
$request = $container->get('request');
/** @var \Psr\Http\Message\ResponseInterface */
$response = $container->get('response');

try {

    $response = $router->dispatch($request, $response);

} catch (\League\Route\Http\Exception\NotFoundException $e) {

    $response->getBody()->write($container->get('templater')->render('errors/404'));
    $response = $response->withStatus(404);

} catch (\Throwable $e) {

        $errorHandler->handleException($e);

        $response->getBody()->write($container->get('templater')->render('errors/500'));
        $response = $response->withStatus(500);

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