<?php

use Zend\Diactoros\Stream;
use Gulchuk\Middlewares\MinifyOutput;
use Gulchuk\Controllers\{PageController, BlogController, AuthController};

// Frontend routes
$route
    ->group('/', function ($route) {
        $route->get('/', PageController::class . '::index');
        $route->get('/cv', PageController::class . '::showCV');
    })
    ->middleware(new MinifyOutput(new Stream('php://memory', 'wb+')));

$route
    ->group('/blog', function ($route) {
        $route->get('/', BlogController::class . '::index');
        $route->get('{slug:slug}', BlogController::class . '::show');
        $route->get('/tag/{slug:slug}', BlogController::class . '::tag');
    })
    ->middleware(new MinifyOutput(new Stream('php://memory', 'wb+')));

// Auth routes
$route->get('/login', AuthController::class . '::login');
$route->post('/login', AuthController::class . '::postLogin');


