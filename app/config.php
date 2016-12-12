<?php

return [
    'debug' => env('APP_DEBUG', false),
    'backend_segment' => env('BACKEND_SEGMENT', 'admin'),
    'images_path_prefix' => env('IMAGES_PATH_PREFIX', '/uploads/img'),
    'app_key' => env('APP_KEY', 'your-app-secret-key'),
    'app_domain' => env('APP_DOMAIN', $_SERVER['HTTP_HOST']),
];
