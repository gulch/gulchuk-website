<?php

namespace Gulchuk\Controllers;

use Psr\Http\Message\ResponseInterface;
use Gulchuk\Repositories\UsersRepository;
use Auth;

class AuthController extends BaseController
{
    public function login() : ResponseInterface
    {
        if (!Auth::guest()) {
            return $this->previous();
        }

        if (Auth::checkRememberTokenAndLogin(UsersRepository::class)) {
            return $this->previous();
        }

        return $this->httpResponse($this->view('backend/auth/login'));
    }

    public function postLogin() : ResponseInterface
    {
        $email = $this->postArgument('email');
        $password = $this->postArgument('password');
        $remember = $this->postArgument('remember');

        $user = (new UsersRepository())->findByEmail($email);
        if (sizeof($user)) {
            if (password_verify($password, $user->password)) {
                // Good! Let's authenticate user...
                Auth::authenticate($user, $remember);

                return $this->redirectResponse('/' . config('backend_segment'));
            }
        }

        return $this->httpResponse($this->view('backend/auth/login', [
            'message' => 'Email or password is wrong!'
        ]));
    }

    public function recover() : ResponseInterface
    {
        return $this->httpResponse($this->view('backend/auth/recover'));
    }

    public function logout() : ResponseInterface
    {
        Auth::logout();

        return $this->redirectResponse();
    }
}
