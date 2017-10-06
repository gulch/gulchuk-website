<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ContentSecurityPolicy
{
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        $response = $next($request, $response);

        $value = "default-src 'self' www.google-analytics.com";
        $value .= "; font-src 'self'";
        $value .= "; img-src data: https:";
        $value .= "; style-src 'self' 'unsafe-inline'";
        $value .= "; object-src 'none'";

        return $response->withHeader('Content-Security-Policy', $value);
    }
}
