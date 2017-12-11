<?php

namespace App\Services;

use hollodotme\FastCGI\Client;
use hollodotme\FastCGI\Requests\PostRequest;
use hollodotme\FastCGI\SocketConnections\UnixDomainSocket;

class JobService
{
    /** @var Client */
    private $client;

    private function init(): void
    {
        $connection = new UnixDomainSocket(
            \config('jobs.php-fpm_socket_path'),  # Socket path to php-fpm
            5000,                                # Connect timeout in milliseconds (default: 5000)
            20000                                # Read/write timeout in milliseconds (default: 5000)
        );

        $this->client = new Client($connection);
    }

    public function process(array $options = []): void
    {
        if (!$this->client) {
            $this->init();
        }

        $request = new PostRequest(
            \projectPath() . '/worker.php',
            \http_build_query($options)
        );

        $this->client->sendAsyncRequest($request);
    }
}
