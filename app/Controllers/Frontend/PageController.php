<?php

namespace Gulchuk\Controllers\Frontend;

use Psr\Http\Message\ResponseInterface;
use Gulchuk\Controllers\BaseController;

class PageController extends BaseController
{
    public function index() : ResponseInterface
    {
        return $this->httpResponse($this->view('frontend/pages/index'));
    }

    public function showCV() : ResponseInterface
    {
        return $this->httpResponse($this->view('frontend/pages/cv'));
    }

    public function showBooks() : ResponseInterface
    {
        return $this->httpResponse($this->view('frontend/pages/books'));
    }
}
