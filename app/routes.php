<?php

$route->group('/', function ($route) {
    $route->get('/', 'Gulchuk\Controllers\PageController::index');
    $route->get('/cv', 'Gulchuk\Controllers\PageController::showCV');
})->middleware(new Gulchuk\Middlewares\MinifyOutput);

$route->group('/blog', function ($route) {
    $route->get('/', 'Gulchuk\Controllers\BlogController::index');
    $route->get('{slug}', 'Gulchuk\Controllers\BlogController::show');
    $route->get('/tag/{slug}', 'Gulchuk\Controllers\BlogController::tag');
})->middleware(new Gulchuk\Middlewares\MinifyOutput);


