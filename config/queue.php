<?php

return [
    'name' => 'gulchuk.com:queue',
    'map'  => [
        'CreateWebp'               => '\App\Jobs\CreateWebpJob::handle',
        'CreateArticleSocialImage' => '\App\Jobs\CreateArticleSocialImageJob::handle',
    ]
];