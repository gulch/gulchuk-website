<?php

namespace App\Middlewares;

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

        $minifier = new \gulch\Minify\Minifier(
            new \gulch\Minify\Processor\WhitespacesRemover,
            new \gulch\Minify\Processor\HtmlCommentsRemover,
            new \gulch\Minify\Processor\InlineCssMinifier,
            new \gulch\Minify\Processor\QuotesRemover,
            new \gulch\Minify\Processor\AttributesSimplifier
        );
        $minifiedBody = $minifier->process($response->getBody());
        $this->stream->write($minifiedBody);

        return $response->withBody($this->stream);
    }
}
