<?php

use Zend\Diactoros\Stream;
use Gulchuk\Middlewares\{
    MinifyOutput,
    StartSession,
    AuthenticateOnly
};
use Gulchuk\Controllers\AuthController;
use Gulchuk\Controllers\Frontend\{
    PageController,
    BlogController
};
use Gulchuk\Controllers\Backend\{
    DashboardController,
    TagsController
};

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
        $route->get('/tag/{slug:slug}', BlogController::class . '::tag');
        $route->get('{slug:slug}', BlogController::class . '::show');
    })
    ->middleware(new MinifyOutput(new Stream('php://memory', 'wb+')));

// Auth routes
$route
    ->group('/auth', function ($route) {
        $route->get('/login', AuthController::class . '::login');
        $route->post('/login', AuthController::class . '::postLogin');
        $route->get('/logout', AuthController::class . '::logout');
        $route->get('/recover', AuthController::class . '::recover');
    })
    ->middleware(new StartSession());

// Backend routes
$route
    ->group('/' . config('backend_segment'), function ($route) {
        $route->get('/', DashboardController::class . '::index');
        $route->get('/tags', TagsController::class . '::index');

    })
    ->middleware(new StartSession())
    ->middleware(new AuthenticateOnly());