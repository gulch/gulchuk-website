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
        $email = $this->argument($this->postInput, 'email');
        $password = $this->argument($this->postInput, 'password');
        $remember = $this->argument($this->postInput, 'remember');

        var_dump($email, $password, $remember);


        return $this->response->withHeader('Location', '/admin');
    }

    public function recover()
    {
        return $this->response($this->view('auth.recover'));
    }

    public function logout()
    {

    }
}
