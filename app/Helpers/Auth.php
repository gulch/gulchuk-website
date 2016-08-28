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
            setcookie('remember', crypt($user->email, 'some-salt'), time()+3600, '/', $_SERVER['HTTP_HOST'], true, true);
        }
    }

    public static function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
    }
}