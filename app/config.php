<?php

return [
    'debug' => env('APP_DEBUG', false),
    'backend_segment' => env('BACKEND_SEGMENT', 'admin'),
    'app_key' => env('APP_KEY', 'your-app-secret-key'),
    'app_domain' => env('APP_DOMAIN', $_SERVER['HTTP_HOST']),
    'images_path_prefix' => env('IMAGES_PATH_PREFIX', '/uploads/img'),
    'images_path_original' => env('IMAGES_PATH_ORIGINAL', '/uploads/img/original'),
    'images_path_editor' => env('IMAGES_PATH_EDITOR', '/uploads/img/editor'),
];
