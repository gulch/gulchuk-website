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
            5000,                                 # Connect timeout in milliseconds (default: 5000)
            20000                                 # Read/write timeout in milliseconds (default: 5000)
        );

        $this->client = new Client($connection);
    }

    private function getClient(): Client
    {
        if (!$this->client) {
            $this->init();
        }

        return $this->client;
    }

    public function process(array $options = []): void
    {
        $request = new PostRequest(
            \projectPath() . '/worker.php',
            \http_build_query($options)
        );

        $this->getClient()->sendAsyncRequest($request);
    }
}
