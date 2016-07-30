<?php

use Phinx\Migration\AbstractMigration;

class ArticleToTag extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('Article_Tag');
        $table->addColumn('article_id', 'integer',['signed' => false])
            ->addColumn('tag_id', 'integer', ['signed' => false])
            ->save();
    }

    public function down()
    {
        $this->dropTable('Article_Tag');
    }
}
