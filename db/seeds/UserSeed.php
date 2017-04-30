<?php

use Phinx\Seed\AbstractSeed;

class UserSeed extends AbstractSeed
{
    public function run()
    {
        $user = [
            'name' => 'Admin',
            'email' => 'admin@gulchuk.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT)
        ];

        $this->insert('User', $user);
    }
}
