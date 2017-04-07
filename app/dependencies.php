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

/* Queue */
$container->share('queue', Queue::class);

/* Assets */
$container->share('DeferJS', function () {
    return new \gulch\Assets\Asset(
        new \gulch\Assets\Renderer\DeferJsRenderer()
    );
});

$container->share('BodyCSS', function () {
    return new \gulch\Assets\Asset(
        new \gulch\Assets\Renderer\BodyCssRenderer()
    );
});

/* Controllers */
$container->add(\Gulchuk\Controllers\AuthController::class);
$container->add(\Gulchuk\Controllers\Frontend\PageController::class);
$container->add(\Gulchuk\Controllers\Frontend\BlogController::class);
$container->add(\Gulchuk\Controllers\Frontend\SitemapController::class);
$container->add(\Gulchuk\Controllers\Backend\DashboardController::class);
$container
    ->add(\Gulchuk\Controllers\Backend\TagsController::class)
    ->withArgument(new \Gulchuk\Repositories\TagsRepository());
$container
    ->add(\Gulchuk\Controllers\Backend\ArticlesController::class)
    ->withArgument(new \Gulchuk\Repositories\ArticlesRepository());


return $container;
