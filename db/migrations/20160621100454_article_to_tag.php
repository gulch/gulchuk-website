<?php

use Phinx\Migration\AbstractMigration;

class ArticleToTag extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('Article_Tag', ['signed' => false, 'collation' => 'utf8mb4_unicode_ci']);
        $table->addColumn('id__Article', 'integer',['signed' => false])
            ->addColumn('id__Tag', 'integer', ['signed' => false])
            ->addForeignKey('id__Tag', 'Tag', 'id', ['delete'=> 'RESTRICT', 'update'=> 'CASCADE'])
            ->addForeignKey('id__Article', 'Article', 'id', ['delete'=> 'RESTRICT', 'update'=> 'CASCADE'])
            ->save();
    }

    public function down()
    {
        $this->dropTable('Article_Tag');
    }
}
