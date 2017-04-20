<?php

namespace Gulchuk\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ResponseTime
{
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $timeStart = round(microtime(true) * 1000);

        $response = $next($request, $response);

        $duration = round(microtime(true) * 1000) - $timeStart;

        return $response->withHeader('X-Response-Time', sprintf('%dms', $duration));
    }
}
