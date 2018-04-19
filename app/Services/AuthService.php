<?php

namespace App\Services;

class AuthService
{
    public static function startSession(): void
    {
        \session_start();
    }

    public static function destroySession(): void
    {
        if (static::check()) {
            unset($_SESSION['user']);
        }

        \session_destroy();
    }

    public static function check(): bool
    {
        static::startSession();

        return isset($_SESSION['user']);
    }


    /**
     * @return \App\Models\User | bool
     */
    public static function user()
    {
        if (static::check()) {
            return $_SESSION['user'];
        }

        return false;
    }

    private static function setUser($user): void
    {
        static::startSession();
        $_SESSION['user'] = $user;
    }

    /**
     * @param \App\Models\User $user
     * @param bool $remember
     * @throws \Exception
     */
    public static function authenticate($user, bool $remember = false): void
    {
        static::setUser($user);

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
                \config('app.domain'),
                true, // secure
                true // httpOnly
            );
        }
    }

    public static function logout()
    {
        \setcookie(
            'remember',
            '',
            \time() - 3600, // remove cookie, set valid to -1 hour ago
            '/',
            \config('app.domain'),
            true, // secure
            true // httpOnly
        );
        static::destroySession();
    }

    /**
     * @param string $usersRepository
     * @return bool
     * @throws \Exception
     */
    public static function checkRememberTokenAndLogin(string $usersRepository): bool
    {
        $remember_token = $_COOKIE['remember'] ?? null;

        if (!$remember_token) {
            return false;
        }

        $user = (new $usersRepository)->findByRememberToken($remember_token);

        if (!$user) {
            return false;
        }

        static::authenticate($user, true);

        return true;
    }

    /**
     * @param int $size Token string symbols count
     * @return string
     * @throws \Exception
     */
    public static function generateRememberToken(int $size = 16): string
    {
        $random_bytes = \random_bytes($size);
        $token = \substr(
            \str_replace(
                ['/', '+', '='],
                '',
                \base64_encode($random_bytes)
            ),
            0,
            $size
        );

        return $token;
    }
}
