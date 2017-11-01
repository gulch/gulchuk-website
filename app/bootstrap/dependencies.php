<?php

$container = new \League\Container\Container;

/* Response */
$container->share('response', \Zend\Diactoros\Response::class);

/* Request */
$container->share('request', function () {
    return \Zend\Diactoros\ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
});

/* Emitter */
$container->share('emitter', \Zend\Diactoros\Response\SapiEmitter::class);

/* Template Engine */
$container->share('templater', function () {
    return new \League\Plates\Engine(__DIR__ . '/../../resources/views');
});

/* Queue */
$container->share('queue', \App\Services\QueueService::class);

/* Assets */
$container->share('DeferJS', function () {
    return new \gulch\Assets\Asset(
        new \gulch\Assets\Renderer\DeferJsRenderer
    );
});

$container->share('BodyCSS', function () {
    return new \gulch\Assets\Asset(
        new \gulch\Assets\Renderer\BodyCssRenderer
    );
});

/* Controllers */
$container->add(\App\Controllers\AuthController::class);
$container->add(\App\Controllers\Frontend\PageController::class);
$container->add(\App\Controllers\Frontend\BlogController::class);
$container->add(\App\Controllers\Frontend\SitemapController::class);
$container->add(\App\Controllers\Backend\DashboardController::class);
$container
    ->add(\App\Controllers\Backend\TagsController::class)
    ->withArgument(new \App\Repositories\TagsRepository);
$container
    ->add(\App\Controllers\Backend\ArticlesController::class)
    ->withArgument(new \App\Repositories\ArticlesRepository);


return $container;
