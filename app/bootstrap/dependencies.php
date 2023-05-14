<?php

/** @var \League\Container\Container $container */

/* Response */
$container->addShared(
    \Psr\Http\Message\ResponseInterface::class,
    \Nyholm\Psr7\Response::class,
)->addTag('response');

/* Request */
$container->addShared(
    \Psr\Http\Message\ServerRequestInterface::class,
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
)->addTag('request');

/* Empty Stream */
$container->add(
    \Psr\Http\Message\StreamInterface::class,
    function () {
        return \Nyholm\Psr7\Stream::create();
    }
);

/* Template Engine */
$container->addShared(
    'templater',
    function () {
        return new \League\Plates\Engine(__DIR__ . '/../../resources/views');
    },
);

/* ORM */
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => config('database.driver'),
    'host' => config('database.host'),
    'unix_socket' => config('database.unix_socket'),
    'database' => config('database.database'),
    'username' => config('database.username'),
    'password' => config('database.password'),
    'charset' => config('database.charset'),
    'collation' => config('database.collation'),
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

/* Repositories */
/* $container->add(\App\Repositories\TagsRepository::class)->addArgument($orm);
$container->add(\App\Repositories\ArticlesRepository::class)->addArgument($orm);
$container->add(\App\Repositories\UsersRepository::class)->addArgument($orm); */

/* Controllers */
/* $container->add(\App\Controllers\Frontend\PageController::class);
$container->add(\App\Controllers\Frontend\SitemapController::class);

$container
    ->add(\App\Controllers\Backend\AuthController::class)
    ->addArgument(\App\Repositories\UsersRepository::class);

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
    ->addArgument(\App\Repositories\ArticlesRepository::class)
    ->addArgument(\App\Repositories\TagsRepository::class); */

/* FastCgiService */
$container->add(\App\Services\JobService::class);

/* Assets */
$container->addShared(
    'defer-css',
    function () {
        return new \gulch\Assets\Asset(
            new \gulch\Assets\Renderer\DeferJsRenderer
        );
    },
);

$container->addShared(
    'body-css',
    function () {
        return new \gulch\Assets\Asset(
            new \gulch\Assets\Renderer\BodyCssRenderer
        );
    },
);
