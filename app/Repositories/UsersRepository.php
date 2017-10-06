<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends BaseRepository
{
    public function __construct()
    {
        $this->modelName = User::class;
    }

    public function findByEmail(string $email)
    {
        return ($this->modelName)::where('email', $email)->first();
    }

    public function findByRememberToken(string $token)
    {
        return ($this->modelName)::where('remember_token', $token)->first();
    }
}