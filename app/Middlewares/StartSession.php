<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class StartSession
{
    public function __invoke(Request $request, Response $response, callable $next = null)
    {
        session_start();
        return $next($request, $response);
    }
}
