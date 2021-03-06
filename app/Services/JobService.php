<?php

namespace App\Services;

use hollodotme\FastCGI\Client;
use hollodotme\FastCGI\Interfaces\ConfiguresSocketConnection;
use hollodotme\FastCGI\Requests\PostRequest;
use hollodotme\FastCGI\SocketConnections\UnixDomainSocket;

class JobService
{
    /** @var Client */
    private $client = null;

    /** @var ConfiguresSocketConnection */
    private $connection = null;

    private function init(): void
    {
        $this->connection = new UnixDomainSocket(
            \config('jobs.php-fpm_socket_path'),  # Socket path to php-fpm
            5000,                                 # Connect timeout in milliseconds (default: 5000)
            20000                                 # Read/write timeout in milliseconds (default: 5000)
        );

        $this->client = new Client();
    }

    private function getClient(): Client
    {
        if ($this->client === null) {
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

        $this->getClient()->sendAsyncRequest($this->connection, $request);
    }
}
