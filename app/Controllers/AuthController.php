<?php

namespace Gulchuk\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        return $this->response($this->view('auth.login'));
    }

    public function postLogin()
    {
        echo 'xyz'; exit();
    }

    public function recover()
    {
        return $this->response($this->view('auth.recover'));
    }
}
