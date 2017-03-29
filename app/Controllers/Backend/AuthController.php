<?php

namespace Gulchuk\Controllers\Backend;

use Psr\Http\Message\ResponseInterface;
use Gulchuk\Repositories\UsersRepository;
use Gulchuk\Controllers\BaseController;
use Auth;

class AuthController extends BaseController
{
    public function login() : ResponseInterface
    {
        $path = $this->getArgument('return') ?: config('backend_segment');

        if (Auth::check() === true) {
            return $this->redirectResponse('/' . $path);
        }

        if (Auth::checkRememberTokenAndLogin(UsersRepository::class)) {
            return $this->redirectResponse('/' . $path);
        }

        return $this->httpResponse($this->view('backend/auth/login'));
    }

    public function postLogin() : ResponseInterface
    {
        $email = $this->postArgument('email');
        $password = $this->postArgument('password');
        $remember = $this->postArgument('remember');
        $path = $this->getArgument('return') ?: config('backend_segment');

        $user = (new UsersRepository())->findByEmail($email);
        if (sizeof($user)) {
            if (password_verify($password, $user->password)) {

                // Good! Let's authenticate user...
                Auth::authenticate($user, $remember);

                return $this->redirectResponse('/' . $path);
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
