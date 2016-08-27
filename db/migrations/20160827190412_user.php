<?php

use Phinx\Migration\AbstractMigration;

class User extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('User');
        $table->addColumn('name', 'string')
              ->addColumn('email', 'string')
              ->addColumn('password', 'string')
              ->addColumn('created_at', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'datetime', ['null' => true])
              ->addIndex('email', ['unique' => true])
              ->save();
    }

    public function down()
    {
        $this->dropTable('User');
    }
}
