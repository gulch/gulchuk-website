<?php

namespace Gulchuk\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController
{
    private $request;
    private $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function index()
    {
        $this->response->setContent('this is index page');
    }

    public function showPage($slug)
    {
        $this->response->setContent("this is '{$slug}' page!");
    }
}
