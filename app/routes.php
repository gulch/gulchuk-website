<?php

use Zend\Diactoros\Stream;

use App\Middlewares\{
    MinifyOutput,
    AuthenticateOnly,
    ResponseTime,
    ContentSecurityPolicy
};

use App\Controllers\Frontend\{
    PageController,
    BlogController,
    SitemapController,
    FeedController
};

use App\Controllers\Backend\{
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
        $router->get('/books', PageController::class . '::showBooks');
        $router->get('/blog', BlogController::class . '::index');
        $router->get('/blog/tag/{slug:slug}', BlogController::class . '::tag');
        $router->get('/blog/{slug:slug}', BlogController::class . '::show');
    })
    ->middleware(new ResponseTime)
    ->middleware(new MinifyOutput(new Stream('php://memory', 'wb+')))
    ->middleware(new ContentSecurityPolicy);

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
        $router->post('/articles/{id:number}/social/image', ArticlesController::class . '::generateSocialImage');
        // images
        $router->post('/images/upload', ImagesController::class . '::upload');

    })
    ->middleware(new ResponseTime)
    ->middleware(new AuthenticateOnly);