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

            // Generate remember token
            $remember_token = static::generateRememberToken(32);

            // save remember token to user table
            $user->remember_token = $remember_token;
            $user->save();

            setcookie(
                'remember',
                $remember_token,
                time() + 172800,
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

    public static function checkRememberTokenAndLogin($userModel)
    {
        $remember_token = $_COOKIE['remember'] ?? null;

        if (!$remember_token) {
            return false;
        }

        $user = $userModel::where('remember_token', $remember_token)->first();

        if (!sizeof($user)) {
            return false;
        }

        static::authenticate($user, true);

        return true;
    }

    public static function generateRememberToken($size)
    {
        $random_bytes = random_bytes($size);
        $string = substr(str_replace(['/', '+', '='], '', base64_encode($random_bytes)), 0, $size);

        return $string;
    }
}