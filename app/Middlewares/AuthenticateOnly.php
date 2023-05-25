<?php

namespace App\Middlewares;

use App\Services\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class AuthenticateOnly implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        if (AuthService::check() === false) {
            $path = \ltrim($_SERVER['REQUEST_URI'], '/');

            return \container(ResponseInterface::class)
                ->withHeader('Location', '/auth/login?return=' . $path);
        }

        return $handler->handle($request);
    }
}
