<?php

namespace App\Middlewares;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class MinifyOutput
{
    private $stream;

    public function __construct()
    {
        $this->stream = \container(StreamInterface::class);
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ): ResponseInterface {
        /** @var ResponseInterface $response */
        $response = $next($request, $response);
        $start_time = \microtime(true);

        $minifier = new \gulch\Minify\Minifier(
            new \gulch\Minify\Processor\WhitespacesRemover,
            new \gulch\Minify\Processor\HtmlCommentsRemover,
            new \gulch\Minify\Processor\QuotesRemover
        );
        $minifiedBody = $minifier->process($response->getBody());
        $this->stream->write($minifiedBody);

        $end_time = \microtime(true);
        $duration = ($end_time - $start_time) * 1000;

        return $response->withBody($this->stream)
            ->withHeader('X-Minify-Time', \sprintf('%2.3f ms', $duration));
    }
}
