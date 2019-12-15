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
        $this->request = \container(ServerRequestInterface::class);
        $this->response = \container(ResponseInterface::class);
        $this->getInput = $this->request->getQueryParams();
        $this->postInput = $this->request->getParsedBody();
    }

    /**
     * Send 404 page with status 404 response
     *
     * @return ResponseInterface
     */
    protected function abort(): ResponseInterface
    {
        return $this->httpResponse($this->view('errors/404'), 404);
    }

    protected function httpResponse(string $data, int $statusCode = 200): ResponseInterface
    {
        $this->response->getBody()->write($data);

        return $this->response->withStatus($statusCode);
    }

    /**
     * Send JSON response
     *
     * @param array $data
     * @param int $statusCode
     * @return ResponseInterface
     */
    protected function jsonResponse(array $data, int $statusCode = 200): ResponseInterface
    {
        $this->response
            ->getBody()
            ->write(\json_encode($data, \JSON_PRETTY_PRINT));

        return $this->response
            ->withStatus($statusCode)
            ->withHeader('content-type', 'application/json');
    }

    /**
     * Send redirect response
     *
     * @param string $url
     * @return ResponseInterface
     */
    protected function redirectResponse(string $url = '/'): ResponseInterface
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
     *
     * @return ResponseInterface
     */
    protected function previous(): ResponseInterface
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
    protected function view(string $name, array $params = []): string
    {
        return \container('templater')->render($name, $params);
    }

    /**
     * Format errors list for message dialog
     *
     * @param
     * @return string
     */
    protected function formatErrorMessages(array $messages): string
    {
        return $this->view('messages/validation', [
            'errors' => $messages,
        ]);
    }
}
