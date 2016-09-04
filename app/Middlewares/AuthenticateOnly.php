<?php

namespace Gulchuk\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Auth;

class AuthenticateOnly
{
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        if(Auth::guest()) {
            return $response->withHeader('Location','/auth/login');
        }

        return $next($request, $response);
    }
}
