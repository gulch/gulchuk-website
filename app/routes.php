<?php

$route->get('/cv', 'Gulchuk\Controllers\PageController::showCvPage');
$route->get('/blog/{slug}', 'Gulchuk\Controllers\BlogController::show');
$route->get('/blog', 'Gulchuk\Controllers\BlogController::index');
$route->get('/', 'Gulchuk\Controllers\PageController::index');
