<?php

class Auth
{

    /**
     * @return Gulchuk\Models\User | bool
     */
    public static function user()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return false;
    }

    public static function guest() : bool
    {
        return !isset($_SESSION['user']);
    }

    /**
     * @param $user Gulchuk\Models\User
     * @param bool $remember
     */
    public static function authenticate($user, $remember = false) : void
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
                \time() + 172800, // +48 hours
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
        \setcookie('remember', '', \time() - 3600, '/', config('app_domain'), true, true);
        \session_destroy();
    }

    /**
     * @param string $usersRepository
     * @return bool
     */
    public static function checkRememberTokenAndLogin(string $usersRepository) : bool
    {
        $remember_token = $_COOKIE['remember'] ?? null;

        if (!$remember_token) {
            return false;
        }

        $user = (new $usersRepository)->findByRememberToken($remember_token);

        if (!sizeof($user)) {
            return false;
        }

        static::authenticate($user, true);

        return true;
    }

    /**
     * @param int $size Token string symbols count
     * @return string
     */
    public static function generateRememberToken(int $size = 16) : string
    {
        $random_bytes = \random_bytes($size);
        $token = \substr(\str_replace(['/', '+', '='], '', \base64_encode($random_bytes)), 0, $size);

        return $token;
    }
}