<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ContentSecurityPolicy implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        /** @var ResponseInterface $response */
        $response = $handler->handle($request);

        $value = "default-src 'self' www.google-analytics.com www.googletagmanager.com";
        $value .= "; font-src 'self'";
        $value .= '; img-src data: https:';
        $value .= "; style-src 'self' 'unsafe-inline'";
        $value .= "; object-src 'none'";

        return $response->withHeader('Content-Security-Policy', $value);
    }
}
