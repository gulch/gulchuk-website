<?php

use Phinx\Migration\AbstractMigration;

class RenameArticleTableImageIdColumn extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('Article');
        $table->renameColumn('image_id', 'id__Image');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table = $this->table('Article');
        $table->renameColumn('id__Image', 'image_id');
    }
}
