<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends BaseRepository
{
    public function getModelClassName(): string
    {
        return User::class;
    }

    public function findByEmail(string $email)
    {
        return ($this->getModelClassName())::query()
            ->where('email', $email)
            ->first();
    }

    public function findByRememberToken(string $token)
    {
        return ($this->getModelClassName())::query()
            ->where('remember_token', $token)
            ->first();
    }
}
