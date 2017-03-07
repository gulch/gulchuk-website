<?php

$container = new \League\Container\Container;

/* Response */
$container->share('response', \Zend\Diactoros\Response::class);

/* Request */
$container->share('request', function() {
   return \Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
});

/* Emitter */
$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);

/* Template Engine */
$container->share('templater', function() {
    return new \League\Plates\Engine(__DIR__ . '/../resources/views');
});

/* Controllers */
$container->add(\Gulchuk\Controllers\AuthController::class);

$container->add(\Gulchuk\Controllers\Frontend\PageController::class);
$container->add(\Gulchuk\Controllers\Frontend\BlogController::class);

$container->add(\Gulchuk\Controllers\Backend\DashboardController::class);
$container->add(\Gulchuk\Controllers\Backend\TagsController::class);

return $container;
