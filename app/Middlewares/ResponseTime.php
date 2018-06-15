<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ResponseTime
{
    private const HEADER = 'X-Response-Time';

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ): ResponseInterface {
        $server = $request->getServerParams();
        $start_time = $server['REQUEST_TIME_FLOAT'] ?? \APP_START_TIME_FLOAT;
        /** @var ResponseInterface $response */
        $response = $next($request, $response);
        $end_time = \microtime(true);
        $duration = ($end_time - $start_time) * 1000;

        return $response->withHeader(self::HEADER, \sprintf('%2.3f ms', $duration));
    }
}
