<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends BaseRepository
{
    public function getModelInstance(): User
    {
        return new User();
    }

    public function findByEmail(string $email)
    {
        return $this->getModelInstance()
            ->where('email', $email)
            ->first();
    }

    public function findByRememberToken(string $token)
    {
        return $this->getModelInstance()
            ->where('remember_token', $token)
            ->first();
    }
}
