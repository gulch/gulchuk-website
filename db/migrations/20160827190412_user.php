<?php

use Phinx\Migration\AbstractMigration;

class User extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('User', ['engine' => 'Aria']);
        $table->addColumn('name', 'string')
              ->addColumn('email', 'string')
              ->addColumn('password', 'string')
              ->addColumn('created_at', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
              ->addIndex('email', ['unique' => true])
              ->save();
    }

    public function down()
    {
        $this->dropTable('User');
    }
}
