<?php

namespace Gulchuk\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends BaseController
{
    private $request;
    private $response;

    public function __construct(Request $request, Response $response)
    {
        parent::__construct();
        $this->request = $request;
        $this->response = $response;
    }

    public function index()
    {
        $this->response->setContent($this->blade->render('frontend.pages.index'));
    }

    public function showCvPage()
    {
        $this->response->setContent($this->blade->render('frontend.pages.cv'));
    }

    public function showPage($slug)
    {
        $this->response->setContent("this is '{$slug}' page!");
    }
}
