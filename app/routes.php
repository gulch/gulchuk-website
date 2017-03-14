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
/**
 * @var \League\Route\RouteCollection $router
 */
$router
    ->group('/', function ($router) {
        $router->get('/', PageController::class . '::index');
        $router->get('/cv', PageController::class . '::showCV');
    })
    ->middleware(new MinifyOutput(new Stream('php://memory', 'wb+')));

$router
    ->group('/blog', function ($router) {
        $router->get('/', BlogController::class . '::index');
        $router->get('/tag/{slug:slug}', BlogController::class . '::tag');
        $router->get('{slug:slug}', BlogController::class . '::show');
    })
    ->middleware(new MinifyOutput(new Stream('php://memory', 'wb+')));

// Auth routes
$router
    ->group('/auth', function ($router) {
        $router->get('/login', AuthController::class . '::login');
        $router->post('/login', AuthController::class . '::postLogin');
        $router->get('/logout', AuthController::class . '::logout');
        $router->get('/recover', AuthController::class . '::recover');
    })
    ->middleware(new StartSession());

// Backend routes
$router
    ->group('/' . config('backend_segment'), function ($router) {
        $router->get('/', DashboardController::class . '::index');
        $router->get('/tags', TagsController::class . '::index');
        $router->get('/tags/create', TagsController::class . '::create');
        $router->post('/tags/save', TagsController::class . '::save');
        $router->post('/tags/{id:number}/remove', TagsController::class . '::remove');

    })
    ->middleware(new StartSession())
    ->middleware(new AuthenticateOnly());