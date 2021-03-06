<?php

namespace App\Controllers\Frontend;

use Psr\Http\Message\ResponseInterface;
use App\Controllers\BaseController;

class PageController extends BaseController
{
    public function index(): ResponseInterface
    {
        return $this->httpResponse($this->view('frontend/pages/index'));
    }

    public function showCV(): ResponseInterface
    {
        return $this->httpResponse($this->view('frontend/pages/cv/index'));
    }

    public function showBooks(): ResponseInterface
    {
        return $this->httpResponse($this->view('frontend/pages/books'));
    }
}
