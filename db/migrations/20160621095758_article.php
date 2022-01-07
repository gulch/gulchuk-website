<?php

use Phinx\Migration\AbstractMigration;

class Article extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('Article', ['signed' => false, 'collation' => 'utf8mb4_unicode_ci']);
        $table->addColumn('slug', 'string')
            ->addColumn('title', 'string')
            ->addColumn('content', 'text')
            ->addColumn('is_published', 'integer', ['default' => 0, 'limit' => 1, 'signed' => false])
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
        $this->table('Article')->drop()->save();
    }
}
