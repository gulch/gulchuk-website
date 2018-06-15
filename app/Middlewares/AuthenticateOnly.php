<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Services\AuthService;

class AuthenticateOnly
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ): ResponseInterface {
        if (AuthService::check() === false) {
            $path = \ltrim($_SERVER['REQUEST_URI'], '/');

            return $response->withHeader('Location', '/auth/login?return=' . $path);
        }

        return $next($request, $response);
    }
}
