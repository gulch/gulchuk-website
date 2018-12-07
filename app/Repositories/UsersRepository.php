<?php

namespace App\Repositories;

use App\DataSource\User\User;

class UsersRepository extends BaseRepository
{
    public function getMapperClassName(): string
    {
        return User::class;
    }

    public function findByEmail(string $email)
    {
        return $this->orm
            ->select($this->getMapperClassName())
            ->where('email = ', $email)
            ->fetchRecord();
    }

    public function findByRememberToken(string $token)
    {
        return $this->orm
            ->select($this->getMapperClassName())
            ->where('remember_token = ', $token)
            ->fetchRecord();
    }
}
