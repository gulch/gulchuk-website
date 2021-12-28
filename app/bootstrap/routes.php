<?php

use App\Controllers\Backend\AuthController;
use App\Controllers\Backend\DashboardController;
use App\Controllers\Backend\TagsController;
use App\Controllers\Backend\ArticlesController;
use App\Controllers\Backend\ImagesController;
use App\Controllers\Frontend\PageController;
use App\Controllers\Frontend\BlogController;
use App\Controllers\Frontend\SitemapController;
use App\Controllers\Frontend\FeedController;
use App\Middlewares\MinifyOutput;
use App\Middlewares\AuthenticateOnly;
use App\Middlewares\ResponseTime;
use App\Middlewares\ContentSecurityPolicy;

/** @var \League\Route\Router $router */

// Frontend routes
$router->get('/sitemap', [SitemapController::class, 'generate']);
$router->get('/feed', [FeedController::class, 'generate']);
$router->get('/rss', [FeedController::class, 'generate']);

$router
    ->group('/', function ($router) {
        /** @var \League\Route\Router $router */
        $router->get('/', [PageController::class, 'index']);
        $router->get('/cv', [PageController::class, 'showCV']);
        $router->get('/books', [PageController::class, 'showBooks']);
        $router->get('/blog', [BlogController::class, 'index']);
        $router->get('/blog/tag/{slug:slug}', [BlogController::class, 'tag']);
        $router->get('/blog/{slug:slug}', [BlogController::class, 'show']);
    })
    ->middlewares([
        new ResponseTime,
        new ContentSecurityPolicy,
        new MinifyOutput
    ]);

// Auth routes
$router
    ->group('/auth', function ($router) {
        /** @var \League\Route\Router $router */
        $router->get('/login', [AuthController::class, 'login']);
        $router->post('/login', [AuthController::class, 'postLogin']);
        $router->get('/logout', [AuthController::class, 'logout']);
        $router->get('/recover', [AuthController::class, 'recover']);
    });

// Backend routes
$router
    ->group('/' . config('app.backend_segment'), function ($router) {
        /** @var \League\Route\Router $router */
        // dashboard
        $router->get('/', [DashboardController::class, 'index']);
        // tags
        $router->get('/tags', [TagsController::class, 'index']);
        $router->get('/tags/create', [TagsController::class, 'create']);
        $router->get('/tags/{id:number}/edit', [TagsController::class, 'edit']);
        $router->post('/tags/save', [TagsController::class, 'save']);
        $router->post('/tags/{id:number}/remove', [TagsController::class, 'remove']);
        // articles
        $router->get('/articles', [ArticlesController::class, 'index']);
        $router->get('/articles/create', [ArticlesController::class, 'create']);
        $router->get('/articles/{id:number}/edit', [ArticlesController::class, 'edit']);
        $router->post('/articles/save', [ArticlesController::class, 'save']);
        $router->post('/articles/{id:number}/remove', [ArticlesController::class, 'remove']);
        $router->post('/articles/{id:number}/publish', [ArticlesController::class, 'publish']);
        $router->post('/articles/{id:number}/unpublish', [ArticlesController::class, 'unpublish']);
        $router->post('/articles/{id:number}/social/image', [ArticlesController::class, 'generateSocialImage']);
        // images
        $router->post('/images/upload', [ImagesController::class, 'upload']);
    })
    ->middlewares([
        new ResponseTime,
        new AuthenticateOnly,
    ]);
