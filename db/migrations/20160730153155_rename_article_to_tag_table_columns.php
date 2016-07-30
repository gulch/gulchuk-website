<?php

use Phinx\Migration\AbstractMigration;

class RenameArticleToTagTableColumns extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('Article_Tag');
        $table->renameColumn('article_id', 'id__Article');
        $table->renameColumn('tag_id', 'id__Tag');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $table = $this->table('Article_Tag');
        $table->renameColumn('id__Tag', 'tag_id');
        $table->renameColumn('id__Article', 'article_id');
    }
}
