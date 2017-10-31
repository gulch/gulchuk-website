<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\InputFilter\InputFilterInterface;

class BaseController
{
    /** @var $request ServerRequestInterface */
    protected $request;
    /** @var $response ResponseInterface */
    protected $response;

    protected $postInput;
    protected $getInput;

    public function __construct()
    {
        $this->request = \container('request');
        $this->response = \container('response');
        $this->getInput = $this->request->getQueryParams();
        $this->postInput = $this->request->getParsedBody();
    }

    protected function abort() : ResponseInterface
    {
        return $this->httpResponse($this->view('errors/404'), 404);
    }

    protected function httpResponse(string $data, int $statusCode = 200) : ResponseInterface
    {
        $this->response->getBody()->write($data);

        return $this->response->withStatus($statusCode);
    }

    protected function jsonResponse(array $data, int $statusCode = 200) : ResponseInterface
    {
        $this->response
            ->getBody()
            ->write(json_encode($data, JSON_PRETTY_PRINT));

        return $this->response
            ->withStatus($statusCode)
            ->withHeader('content-type','application/json');
    }

    protected function redirectResponse(string $url = '/') : ResponseInterface
    {
        return $this->response->withHeader('Location', $url);
    }

    protected function argument(string $name, array $args)
    {
        if (empty($args)) {
            return null;
        }

        return isset($args[$name]) ? $args[$name] : null;
    }

    protected function postArgument(string $name)
    {
        return $this->argument($name, $this->postInput);
    }

    protected function getArgument(string $name)
    {
        return $this->argument($name, $this->getInput);
    }

    /**
     * Redirect to previous page or to index page
     * @return ResponseInterface
     */
    protected function previous() : ResponseInterface
    {
        $url = $_SERVER['HTTP_REFERER'] ?? '/';

        return $this->redirectResponse($url);
    }

    /**
     * Render view by template engine
     *
     * @param string $name
     * @param array $params
     * @return string
     */
    protected function view(string $name, array $params = []) : string
    {
        return \container('templater')->render($name, $params);
    }

    protected function formatErrorMessages(InputFilterInterface $inputFilter): string
    {
        $result = '';

        foreach ($inputFilter->getInvalidInput() as $key => $error) {
            $result .= '<li>Field "'. $key .'":<ul><li>' . implode('</li><li>', $error->getMessages()) . '</li></ul></li>';
        }

        $result = '<ul>' . $result . '</ul>';

        return $result;
    }
}
