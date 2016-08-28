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
    protected $postInput;
    protected $getInput;

    public function __construct(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->blade = new BladeInstance(__DIR__ . '/../../resources/views', __DIR__ . '/../../cache/views');
        $this->getInput = $request->getQueryParams();
        $this->postInput = $request->getParsedBody();
    }
    
    protected function abort() : ResponseInterface
    {
        return $this->response($this->view('errors.404'), 404);
    }

    protected function response(string $data, int $statusCode = 200) : ResponseInterface
    {
        $this->response->getBody()->write($data);

        return $this->response->withStatus($statusCode);
    }

    protected function argument(array $args, string $name)
    {
        if (empty($args)) {
            return null;
        }

        return isset($args[$name]) ? $args[$name] : null;
    }

    /**
     * Render Blade Template View
     * @param string $name
     * @param array $params
     * @return string
     */
    protected function view(string $name, array $params = []) : string
    {
        return $this->blade->render($name, $params);
    }
}
