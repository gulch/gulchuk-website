<?php

class Auth
{
    public static function user()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return false;
    }

    public static function guest()
    {
        return !isset($_SESSION['user']);
    }

    public static function authenticate($user, $remember = false)
    {
        $_SESSION['user'] = $user;
        if ($remember) {
            setcookie(
                'remember',
                crypt($user->email, config('app_key')),
                time() + 3600,
                '/',
                config('app_domain'),
                true, // secure
                true // httpOnly
            );
        }
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        setcookie('remember', '', time() - 3600, '/', config('app_domain'), true, true);
        session_destroy();
    }
}