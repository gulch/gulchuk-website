<?php

namespace Gulchuk\Controllers;

class PageController extends BaseController
{
    public function index()
    {
        $this->response->getBody()->write($this->blade->render('frontend.pages.index'));
    }

    public function showCvPage()
    {
        $this->response->getBody()->write($this->blade->render('frontend.pages.cv'));
    }

    /*public function showPage($slug)
    {
        $this->response->getBody()->write("this is '{$slug}' page!");
    }*/
}
