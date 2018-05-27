<?php

return [
    'php-fpm_socket_path' => env('PHP_FPM_SOCKET_PATH', '/var/run/php/php7.2-fpm.sock'),
    'map' => [
        'CreateWebp'                 => '\App\Jobs\CreateWebpJob::handle',
        'CreateArticleSocialImage'   => '\App\Jobs\CreateArticleSocialImageJob::handle',
    ]
];
