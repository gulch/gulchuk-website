<?php

use Zend\Diactoros\Stream;

use Gulchuk\Middlewares\{
    MinifyOutput,
    AuthenticateOnly
};

use Gulchuk\Controllers\Frontend\{
    PageController,
    BlogController,
    SitemapController,
    FeedController
};

use Gulchuk\Controllers\Backend\{
    AuthController,
    DashboardController,
    TagsController,
    ArticlesController,
    ImagesController
};

// Frontend routes
/**
 * @var \League\Route\RouteCollection $router
 */
$router->get('/sitemap', SitemapController::class . '::generate');
$router->get('/feed', FeedController::class . '::generate');
$router->get('/rss', FeedController::class . '::generate');

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
    });

// Backend routes
$router
    ->group('/' . config('backend_segment'), function ($router) {
        // dashboard
        $router->get('/', DashboardController::class . '::index');
        // tags
        $router->get('/tags', TagsController::class . '::index');
        $router->get('/tags/create', TagsController::class . '::create');
        $router->get('/tags/{id:number}/edit', TagsController::class . '::edit');
        $router->post('/tags/save', TagsController::class . '::save');
        $router->post('/tags/{id:number}/remove', TagsController::class . '::remove');
        // articles
        $router->get('/articles', ArticlesController::class . '::index');
        $router->get('/articles/create', ArticlesController::class . '::create');
        $router->get('/articles/{id:number}/edit', ArticlesController::class . '::edit');
        $router->post('/articles/save', ArticlesController::class . '::save');
        $router->post('/articles/{id:number}/remove', ArticlesController::class . '::remove');
        $router->post('/articles/{id:number}/publish', ArticlesController::class . '::publish');
        $router->post('/articles/{id:number}/unpublish', ArticlesController::class . '::unpublish');
        // images
        $router->post('/images/upload', ImagesController::class . '::upload');

    })
    ->middleware(new AuthenticateOnly());