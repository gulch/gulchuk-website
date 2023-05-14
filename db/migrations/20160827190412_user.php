<?php

use Phinx\Migration\AbstractMigration;

class User extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('User', ['signed' => false, 'collation' => 'utf8mb4_0900_ai_ci']);
        $table->addColumn('name', 'string')
              ->addColumn('email', 'string')
              ->addColumn('password', 'string')
              ->addColumn('created_at', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('remember_token', 'string', ['limit' => 60, 'default' => ''])
              ->addIndex('email', ['unique' => true])
              ->save();
    }

    public function down()
    {
        $this->table('User')->drop()->save();
    }
}
