<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ResponseTime implements MiddlewareInterface
{
    private const HEADER = 'X-Response-Time';

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        $server = $request->getServerParams();
        $start_time = $server['REQUEST_TIME_FLOAT'] ?? \APP_START_TIME_FLOAT;
        /** @var ResponseInterface $response */
        $response = $handler->handle($request);
        $end_time = \microtime(true);
        $duration = ($end_time - $start_time) * 1000;

        return $response->withHeader(self::HEADER, \sprintf('%2.3f ms', $duration));
    }
}
