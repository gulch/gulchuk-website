<?php

use Phinx\Migration\AbstractMigration;

class Image extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('Image');
        $table
            ->addColumn('alt', 'string')
            ->addColumn('path', 'string', ['null' => false])
            ->addColumn('created_at', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();
    }

    public function down()
    {
        $this->dropTable('Image');
    }
}
