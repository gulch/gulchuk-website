<?php

namespace Gulchuk\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BaseController
{
    protected $request;
    protected $response;
    protected $postInput;
    protected $getInput;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->getInput = $request->getQueryParams();
        $this->postInput = $request->getParsedBody();
    }
    
    protected function abort() : ResponseInterface
    {
        return $this->response($this->view('errors/404'), 404);
    }

    protected function response(string $data, int $statusCode = 200) : Response
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
     * Render view by template engine
     * @param string $name
     * @param array $params
     * @return string
     */
    protected function view(string $name, array $params = []) : string
    {
        return container('templater')->render($name, $params);
    }
}
