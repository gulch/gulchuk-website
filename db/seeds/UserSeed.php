<?php

use Phinx\Seed\AbstractSeed;

class UserSeed extends AbstractSeed
{
    public function run()
    {
        $user = [
            'name' => 'Admin',
            'email' => 'admin@website.com',
            'password' => password_hash('my-secret-password', PASSWORD_DEFAULT)
        ];

        $this->insert('User', $user);
    }
}
