<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ContentSecurityPolicy
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ): ResponseInterface {
        /** @var ResponseInterface $response */
        $response = $next($request, $response);

        $value = "default-src 'self' www.google-analytics.com";
        $value .= "; font-src 'self'";
        $value .= "; img-src data: https:";
        $value .= "; style-src 'self' 'unsafe-inline'";
        $value .= "; object-src 'none'";

        return $response->withHeader('Content-Security-Policy', $value);
    }
}
