<?php

/** @var $container \League\Container\Container */

/* Response */
$container->add(
    'response',
    \Nyholm\Psr7\Response::class,
    true
);

/* Request */
$container->add(
    'request',
    function () {
        $psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();
        $creator = new \Nyholm\Psr7Server\ServerRequestCreator(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        return $creator->fromGlobals();
    },
    true
);

/* Empty Stream */
$container->add(
    \Psr\Http\Message\StreamInterface::class,
    function () {
        return \Nyholm\Psr7\Stream::create();
    }
);

/* Emitter */
$container->add(
    'emitter',
    \Narrowspark\HttpEmitter\SapiEmitter::class
);

/* Template Engine */
$container->add(
    'templater',
    function () {
        return new \League\Plates\Engine(__DIR__ . '/../../resources/views');
    },
    true
);

/* ORM */
$orm = \Atlas\Orm\Atlas::new(
    config('database.driver') . ':host=' . config('database.host') . ';dbname=' . config('database.database'),
    config('database.username'),
    config('database.password')
);
$container->add(
    'orm',
    function () use ($orm) {
        return $orm;
    },
    true
);

/* Repositories */
$container->add(\App\Repositories\TagsRepository::class)->addArgument($orm);
$container->add(\App\Repositories\ArticlesRepository::class)->addArgument($orm);

/* Controllers */
$container->add(\App\Controllers\Frontend\PageController::class);
$container->add(\App\Controllers\Frontend\SitemapController::class);
$container->add(\App\Controllers\Backend\AuthController::class);
$container->add(\App\Controllers\Backend\DashboardController::class);

$container
    ->add(\App\Controllers\Frontend\BlogController::class)
    ->addArgument(\App\Repositories\ArticlesRepository::class)
    ->addArgument(\App\Repositories\TagsRepository::class);

$container
    ->add(\App\Controllers\Backend\TagsController::class)
    ->addArgument(\App\Repositories\TagsRepository::class);

$container
    ->add(\App\Controllers\Backend\ArticlesController::class)
    ->addArgument(\App\Repositories\ArticlesRepository::class);

/* FastCgiService */
$container->add('job-service', \App\Services\JobService::class, true);

/* Assets */
$container->add(
    'defer-css',
    function () {
        return new \gulch\Assets\Asset(
            new \gulch\Assets\Renderer\DeferJsRenderer
        );
    },
    true
);

$container->add(
    'body-css',
    function () {
        return new \gulch\Assets\Asset(
            new \gulch\Assets\Renderer\BodyCssRenderer
        );
    },
    true
);
