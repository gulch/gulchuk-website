<?php

$container = new League\Container\Container;

$container->add('Request', \Symfony\Component\HttpFoundation\Request::createFromGlobals(), true);
$container->add('Response', \Symfony\Component\HttpFoundation\Response::create(), true);
$container->add(\Gulchuk\Controllers\PageController::class)
    ->withArgument('Request')
    ->withArgument('Response');

$container->add(\Gulchuk\Controllers\AuthController::class)
    ->withArgument('Request')
    ->withArgument('Response');

return $container;
