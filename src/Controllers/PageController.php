<?php

namespace Gulchuk\Controllers;

class PageController extends BaseController
{
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
