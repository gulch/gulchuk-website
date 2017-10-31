<?php

namespace App\Middlewares;

use gulch\GMinify;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class MinifyOutput
{
    private $stream;

    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    public function __invoke(Request $request, Response $response, callable $next = null): Response
    {
        $response = $next($request, $response);

        $minifiedBody = GMinify::minifyHTML($response->getBody());
        $this->stream->write($minifiedBody);

        return $response->withBody($this->stream);
    }
}
