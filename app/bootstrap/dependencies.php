<?php

$container = new \League\Container\Container;

/* Response */
$container->share(
    'response',
    \Nyholm\Psr7\Response::class
);

/* Request */
$container->share('request', function () {
    return (new \Nyholm\Psr7\Factory\ServerRequestFactory)->createServerRequestFromGlobals();
});

/* Empty Stream */
$container->add(
    \Psr\Http\Message\StreamInterface::class,
    (new \Nyholm\Psr7\Factory\StreamFactory)->createStream()
);

/* Emitter */
$container->share(
    'emitter',
    \Narrowspark\HttpEmitter\SapiEmitter::class
);

/* Template Engine */
$container->share('templater', function () {
    return new \League\Plates\Engine(__DIR__ . '/../../resources/views');
});

/* FastCgiService */
$container->share('job-service', \App\Services\JobService::class);

/* Assets */
$container->share('defer-css', function () {
    return new \gulch\Assets\Asset(
        new \gulch\Assets\Renderer\DeferJsRenderer
    );
});

$container->share('body-css', function () {
    return new \gulch\Assets\Asset(
        new \gulch\Assets\Renderer\BodyCssRenderer
    );
});

/* Controllers */

$container->add(\App\Controllers\Frontend\PageController::class);
$container->add(\App\Controllers\Frontend\BlogController::class);
$container->add(\App\Controllers\Frontend\SitemapController::class);
$container->add(\App\Controllers\Backend\AuthController::class);
$container->add(\App\Controllers\Backend\DashboardController::class);
$container
    ->add(\App\Controllers\Backend\TagsController::class)
    ->withArgument(new \App\Repositories\TagsRepository);
$container
    ->add(\App\Controllers\Backend\ArticlesController::class)
    ->withArgument(new \App\Repositories\ArticlesRepository);


return $container;
