<?php

namespace Gulchuk\Controllers;

class AuthController extends BaseController
{
    public function showLoginPage()
    {
        $this->response->setContent($this->blade->render('auth.login'));
    }
}