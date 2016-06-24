<?php

return [
    ['GET', '/login', 'Gulchuk\Controllers\AuthController::showLoginPage'],
    ['GET', '/cv', 'Gulchuk\Controllers\PageController::showCvPage'],
    ['GET', '/blog/{slug}', 'Gulchuk\Controllers\BlogController::show'],
    ['GET', '/blog', 'Gulchuk\Controllers\BlogController::index'],
    ['GET', '/', 'Gulchuk\Controllers\PageController::index']
];
