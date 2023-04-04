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

/* Emitter */
$container->add(
    'emitter',
    \Embryo\Http\Emitter\Emitter::class
);

/* Template Engine */
$container->addShared(
    'templater',
    function () {
        return new \League\Plates\Engine(__DIR__ . '/../../resources/views');
    },
);

/* ORM */
/* $orm = \Atlas\Orm\Atlas::new(
    config('database.driver') . ':host=' . config('database.host') . ';dbname=' . config('database.database'),
    config('database.username'),
    config('database.password')
); */

/* ORM */

use Cycle\Database;
use Cycle\Database\Config;

$dbal = new Database\DatabaseManager(
    new Config\DatabaseConfig([
        'default' => 'default',
        'databases' => [
            'default' => ['connection' => 'mysql_socket']
        ],
        'connections' => [
            'mysql_socket' => new Config\MySQLDriverConfig(
                connection: new Config\MySQL\SocketConnectionConfig(
                    database: config('database.database'),
                    socket: config('database.socket'),
                    user: config('database.username'),
                    password: config('database.password'),
                ),
                queryCache: true
            ),
        ]
    ])
);

use Cycle\ORM;
use Cycle\ORM\Schema;

$schemes = require __DIR__ . '/../../config/schemes.php';

$orm = new ORM\ORM(
    new ORM\Factory($dbal), 
    new Schema($schemes)
);

$container->addShared(
    'orm',
    function () use ($orm) {
        return $orm;
    },
);

/* Repositories */
$container->add(\App\Repositories\TagsRepository::class)->addArgument($orm);
$container->add(\App\Repositories\ArticlesRepository::class)->addArgument($orm);
$container->add(\App\Repositories\UsersRepository::class)->addArgument($orm);

/* Controllers */
$container->add(\App\Controllers\Frontend\PageController::class);
$container->add(\App\Controllers\Frontend\SitemapController::class);

/* $container
    ->add(\App\Controllers\Backend\AuthController::class)
    ->addArgument(\App\Repositories\UsersRepository::class);

$container->add(\App\Controllers\Backend\DashboardController::class); */

$container
    ->add(\App\Controllers\Frontend\BlogController::class)
    ->addArgument(\App\Repositories\ArticlesRepository::class)
    ->addArgument(\App\Repositories\TagsRepository::class);

/* $container
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
