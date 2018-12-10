<?php

namespace App\Middlewares;

use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MinifyOutput implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        /** @var ResponseInterface $response */
        $response = $handler->handle($request);

        $start_time = \microtime(true);

        $minifier = new \gulch\Minify\Minifier(
            new \gulch\Minify\Processor\WhitespacesRemover,
            new \gulch\Minify\Processor\HtmlCommentsRemover,
            new \gulch\Minify\Processor\QuotesRemover
        );
        $minifiedBody = $minifier->process($response->getBody());

        /** @var StreamInterface $stream */
        $stream = \container(StreamInterface::class);
        $stream->write($minifiedBody);

        $end_time = \microtime(true);
        $duration = ($end_time - $start_time) * 1000;

        return $response
            ->withBody($stream)
            ->withHeader('X-Minify-Time', \sprintf('%2.3f ms', $duration));
    }
}
