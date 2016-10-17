<?php

use Phinx\Migration\AbstractMigration;

class AddRememeberTokenFieldToUserTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('User');
        $table->addColumn('remember_token', 'string', ['limit' => 60, 'default' => ''])->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table = $this->table('User');
        $table->removeColumn('remember_token');
    }
}
