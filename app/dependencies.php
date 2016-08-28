<?php

$container = new League\Container\Container;

$container->add('Psr\Http\Message\ResponseInterface', \Zend\Diactoros\Response::class, true);
$container->add('Psr\Http\Message\ServerRequestInterface', function() {
   return \Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
}, true);
$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

$container
    ->add(\Gulchuk\Controllers\Frontend\PageController::class)
    ->withArguments([
        'Psr\Http\Message\ServerRequestInterface',
        'Psr\Http\Message\ResponseInterface'
    ]);

$container
    ->add(\Gulchuk\Controllers\Frontend\BlogController::class)
    ->withArguments([
        'Psr\Http\Message\ServerRequestInterface',
        'Psr\Http\Message\ResponseInterface'
    ]);

$container
    ->add(\Gulchuk\Controllers\AuthController::class)
    ->withArguments([
        'Psr\Http\Message\ServerRequestInterface',
        'Psr\Http\Message\ResponseInterface'
    ]);

$container
    ->add(\Gulchuk\Controllers\Backend\DashboardController::class)
    ->withArguments([
        'Psr\Http\Message\ServerRequestInterface',
        'Psr\Http\Message\ResponseInterface'
    ]);

return $container;
