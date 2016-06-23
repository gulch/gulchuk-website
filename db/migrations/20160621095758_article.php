<?php

use Phinx\Migration\AbstractMigration;

class Article extends AbstractMigration
{
    public function up()
    {
        $article = $this->table('Article', ['engine' => 'Aria']);
        $article->addColumn('slug', 'string', ['limit' => 70])
            ->addColumn('title', 'string')
            ->addColumn('content', 'text')
            ->addColumn('image_id', 'integer', ['signed' => false])
            ->addColumn('seo_title', 'string', ['null' => true])
            ->addColumn('seo_description', 'string', ['null' => true])
            ->addColumn('seo_keywords', 'string', ['null' => true])
            ->addColumn('created_at', 'datetime', ['null' => true])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['image_id'])
            ->addIndex('slug', ['unique' => true])
            ->save();
    }

    public function down()
    {
        $this->dropTable('Article');
    }
}