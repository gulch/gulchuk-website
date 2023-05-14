<?php

use Phinx\Migration\AbstractMigration;

class Tag extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('Tag', ['signed' => false, 'collation' => 'utf8mb4_0900_ai_ci']);
        $table->addColumn('slug', 'string')
            ->addColumn('title', 'string')
            ->addColumn('content', 'text')
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
        $this->table('Tag')->drop()->save();
    }
}
