<?php

namespace Gulchuk\Middlewares;

use gulch\GMinify;
use Zend\Diactoros\Stream;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MinifyOutput
{
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $response = $next($request, $response);
        $minifiedResponse = GMinify::minifyHTML($response->getBody());

        $stream = new Stream('php://memory', 'wb+');
        $stream->write($minifiedResponse);

        return $response->withBody($stream);
    }
}
