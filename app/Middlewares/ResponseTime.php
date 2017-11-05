<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ResponseTime
{
    const HEADER = 'X-Response-Time';

    public function __invoke(Request $request, Response $response, callable $next = null): Response
    {
        $server = $request->getServerParams();

        if (!isset($server['REQUEST_TIME_FLOAT'])) {
            $server['REQUEST_TIME_FLOAT'] = microtime(true);
        }

        $response = $next($request, $response);

        $duration = (microtime(true) - $server['REQUEST_TIME_FLOAT']) * 1000;

        return $response->withHeader(self::HEADER, sprintf('%2.3f ms', $duration));
    }
}
