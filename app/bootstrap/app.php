<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

define('APP_START_TIME_FLOAT', microtime(true));

require __DIR__ . '/../../vendor/autoload.php';

/* Load main components of application */
require __DIR__ . '/core.php';

/* Register Logger */
$logger = new \Monolog\Logger(config('app.name'), [
    new \Monolog\Handler\StreamHandler(projectPath() . '/storage/logs/' . date('Ymd') . '.log'),
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

/* Router & Routes */
$strategy = new League\Route\Strategy\ApplicationStrategy;
$strategy->setContainer($container);
$router = (new League\Route\Router)->setStrategy($strategy);
require __DIR__ . '/routes.php';

/** @var \Psr\Http\Message\RequestInterface */
$request = $container->get('request');

/** @var \Psr\Http\Message\ResponseInterface */
$response = $container->get('response');

try {
    $response = $router->dispatch($request);
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
