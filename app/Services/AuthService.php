<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public static function startSession(): void
    {
        if (\session_status() === \PHP_SESSION_NONE) {
            \session_start();
        }
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

    public static function user(): ?object
    {
        if (static::check()) {
            return $_SESSION['user'];
        }

        return null;
    }

    private static function setUser($user): void
    {
        static::startSession();
        $_SESSION['user'] = $user;
    }

    public static function login(
        string $email,
        string $password,
        bool $remember = false
    ): bool {
        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            return false;
        }

        if (\password_verify($password, $user->password)) {
            if (\password_needs_rehash($user->password, \PASSWORD_ARGON2ID)) {
                $user->password = \password_hash($password, \PASSWORD_ARGON2ID);
                $user->save();
            }

            // Good! Let's authenticate user...
            static::authenticate($user, $remember);

            return true;
        }

        return false;
    }

    public static function authenticate(User $user, bool $remember = false): void
    {
        static::setUser($user);

        if ($remember) {
            // Generate remember token
            $remember_token = static::generateRememberToken(32);

            // save remember token to user table
            $user->remember_token = $remember_token;
            $user->save();

            \setcookie(
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

    public static function logout(): void
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

    public static function checkRememberTokenAndLogin(): bool
    {
        $remember_token = $_COOKIE['remember'] ?? null;

        if (!$remember_token) {
            return false;
        }

        $user = User::query()
            ->where('remember_token', $remember_token)
            ->first();

        if (!$user) {
            return false;
        }

        static::authenticate($user, true);

        return true;
    }

    public static function generateRememberToken(int $length = 16): string
    {
        $random_bytes = \random_bytes($length);

        $token = \substr(
            \str_replace(
                ['/', '+', '='],
                '',
                \base64_encode($random_bytes)
            ),
            0,
            $length
        );

        return $token;
    }
}
