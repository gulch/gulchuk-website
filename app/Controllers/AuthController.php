<?php

namespace Gulchuk\Controllers;

use Gulchuk\Models\User;
use Auth;

class AuthController extends BaseController
{
    public function login()
    {
        if (!Auth::guest()) {
            return $this->previous();
        }

        if (Auth::checkRememberTokenAndLogin(User::class)) {
            return $this->previous();
        }

        return $this->response($this->view('auth/login'));
    }

    public function postLogin()
    {
        $email = $this->argument($this->postInput, 'email');
        $password = $this->argument($this->postInput, 'password');
        $remember = $this->argument($this->postInput, 'remember');

        $user = User::where('email', $email)->first();
        if (sizeof($user)) {
            if (password_verify($password, $user->password)) {
                // Good! Authenticate user.
                Auth::authenticate($user, $remember);

                return $this->response->withHeader('Location', '/' . config('backend_segment'));
            }
        }

        return $this->response($this->view('auth/login', [
            'message' => 'Email or password is wrong!'
        ]));
    }

    public function recover()
    {
        return $this->response($this->view('auth/recover'));
    }

    public function logout()
    {
        Auth::logout();

        return $this->response->withHeader('Location', '/');
    }
}
