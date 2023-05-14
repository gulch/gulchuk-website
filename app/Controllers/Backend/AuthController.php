<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Services\AuthService;
use Psr\Http\Message\ResponseInterface;

final class AuthController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(): ResponseInterface
    {
        $path = $this->getArgument('return') ?: \config('app.backend_segment');

        if (AuthService::check() === true) {
            return $this->redirectResponse('/' . $path);
        }

        if (AuthService::checkRememberTokenAndLogin()) {
            return $this->redirectResponse('/' . $path);
        }

        return $this->httpResponse($this->view('backend/auth/login'));
    }

    public function postLogin(): ResponseInterface
    {
        $email = $this->postArgument('email');
        $password = $this->postArgument('password');
        $remember = $this->postArgument('remember') ?: false;
        $path = $this->getArgument('return') ?: \config('app.backend_segment');

        if (AuthService::login($email, $password, $remember)) {
            return $this->redirectResponse('/' . $path);
        }

        return $this->httpResponse($this->view('backend/auth/login', [
            'message' => 'Email or password is wrong!'
        ]));
    }

    public function recover(): ResponseInterface
    {
        return $this->httpResponse($this->view('backend/auth/recover'));
    }

    public function logout(): ResponseInterface
    {
        AuthService::logout();

        return $this->redirectResponse();
    }
}
