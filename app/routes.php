<?php

use Zend\Diactoros\Stream;
use Gulchuk\Middlewares\MinifyOutput;

$route
    ->group('/', function ($route) {
        $route->get('/', 'Gulchuk\Controllers\PageController::index');
        $route->get('/cv', 'Gulchuk\Controllers\PageController::showCV');
    })
    ->middleware(new MinifyOutput(new Stream('php://memory', 'wb+')));

$route
    ->group('/blog', function ($route) {
        $route->get('/', 'Gulchuk\Controllers\BlogController::index');
        $route->get('{slug:slug}', 'Gulchuk\Controllers\BlogController::show');
        $route->get('/tag/{slug:slug}', 'Gulchuk\Controllers\BlogController::tag');
    })
    ->middleware(new MinifyOutput(new Stream('php://memory', 'wb+')));


