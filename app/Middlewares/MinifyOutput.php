<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class MinifyOutput implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        
        /** @var ResponseInterface $response */
        $response = $handler->handle($request);

        $minifier = new \gulch\Minify\Minifier(
            new \gulch\Minify\Processor\HtmlCommentsRemover,
            new \gulch\Minify\Processor\WhitespacesRemover,
            new \App\Processors\QuotesRemover,
        );

        /** @var StreamInterface $stream */
        $stream = \container(StreamInterface::class);
        $stream->write(
            $minifier->process($response->getBody())
        );

        return $response->withBody($stream);
    }
}
