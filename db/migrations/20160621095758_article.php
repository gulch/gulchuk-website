<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Article extends AbstractMigration
{
    public function up()
    {
        $article = $this->table('Article');
        $article->addColumn('slug', 'string', ['limit' => 70])
            ->addColumn('title', 'string')
            ->addColumn('content', 'text')
            ->addColumn('is_published', 'integer', ['default' => 0, 'signed' => false, 'limit' => MysqlAdapter::INT_TINY])
            ->addColumn('social_image', 'string', ['null' => true])
            ->addColumn('seo_title', 'string', ['null' => true])
            ->addColumn('seo_description', 'string', ['null' => true])
            ->addColumn('seo_keywords', 'string', ['null' => true])
            ->addColumn('created_at', 'datetime', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex('slug', ['unique' => true])
            ->save();
    }

    public function down()
    {
        $this->dropTable('Article');
    }
}
