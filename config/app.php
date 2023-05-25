<?php

return [
    'name'                 => env('APP_NAME', 'GULCHUK.COM'),
    'key'                  => env('APP_KEY', 'your-app-secret-key'),
    'domain'               => env('APP_DOMAIN', 'gulchuk.com'),
    'url'                  => env('APP_URL', 'https://gulchuk.com'),
    'version'              => env('APP_VERSION', '1.0.0'),
    'debug'                => env('APP_DEBUG', false),
    'backend_segment'      => env('BACKEND_SEGMENT', 'admin'),

    'images_path_prefix'   => env('IMAGES_PATH_PREFIX', '/uploads/img'),
    'images_path_original' => env('IMAGES_PATH_ORIGINAL', '/uploads/img/original'),
    'images_path_editor'   => env('IMAGES_PATH_EDITOR', '/uploads/img/editor'),
    'images_path_social'   => env('IMAGES_PATH_SOCIAL', '/uploads/img/social'),
    'default_social_image' => '/assets/img/default-social-image.png',
    'built_assets_path'    => env('BUILT_ASSETS_PATH', '/a/'),
    'google_analytics_id'  => env('GOOGLE_ANALYTICS_ID'),
];
