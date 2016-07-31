<?php

$route->get('/', 'Gulchuk\Controllers\PageController::index');
$route->get('/cv', 'Gulchuk\Controllers\PageController::showCV');

$route->get('/blog', 'Gulchuk\Controllers\BlogController::index');
$route->get('/blog/{slug}', 'Gulchuk\Controllers\BlogController::show');