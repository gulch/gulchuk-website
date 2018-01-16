<?php

namespace App\Controllers\Backend;

use Psr\Http\Message\ResponseInterface;
use App\Repositories\UsersRepository;
use App\Controllers\BaseController;
use App\Services\AuthService;

class AuthController extends BaseController
{
    public function login(): ResponseInterface
    {
        $path = $this->getArgument('return') ?: \config('app.backend_segment');

        if (AuthService::check() === true) {
            return $this->redirectResponse('/' . $path);
        }

        if (AuthService::checkRememberTokenAndLogin(UsersRepository::class)) {
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

        $user = (new UsersRepository)->findByEmail($email);
        if ($user) {
            if (\password_verify($password, $user->password)) {
                $hash = \password_hash($password, PASSWORD_ARGON2I);

                if (\password_needs_rehash($hash, PASSWORD_ARGON2I)) {
                    $user->password = $hash;
                    $user->save();
                }

                // Good! Let's authenticate user...
                AuthService::authenticate($user, $remember);

                return $this->redirectResponse('/' . $path);
            }
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
