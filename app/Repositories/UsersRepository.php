<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends BaseRepository
{
    public function getModelName()
    {
        return User::class;
    }

    public function findByEmail(string $email)
    {
        return ($this->getModelName())::where('email', $email)->first();
    }

    public function findByRememberToken(string $token)
    {
        return ($this->getModelName())::where('remember_token', $token)->first();
    }
}