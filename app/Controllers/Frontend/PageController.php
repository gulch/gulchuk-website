<?php

namespace Gulchuk\Controllers\Frontend;

use Gulchuk\Controllers\BaseController;

class PageController extends BaseController
{
    public function index()
    {
        return $this->response($this->view('frontend.pages.index'));
    }

    public function showCV()
    {
        return $this->response($this->view('frontend.pages.cv'));
    }
}
