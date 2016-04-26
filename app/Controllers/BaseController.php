<?php

namespace Gulchuk\Controllers;

use duncan3dc\Laravel\BladeInstance;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController
{
    protected $blade;
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->blade = new BladeInstance(__DIR__ . '/../Views', __DIR__ . '/../../cache/views');
    }
}
