<?php

namespace Gulchuk\Controllers;

use duncan3dc\Laravel\BladeInstance;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BaseController
{
    protected $blade;
    protected $request;
    protected $response;

    public function __construct(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->blade = new BladeInstance(__DIR__ . '/../../resources/views', __DIR__ . '/../../cache/views');
    }
    
    protected function show404()
    {
        $this->response->getStatusCode(404);
        $this->response->getBody()->write($this->blade->render('errors.404'));
    }
}
