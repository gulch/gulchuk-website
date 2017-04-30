<?php

use Phinx\Migration\AbstractMigration;

class ArticleToTag extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('Article_Tag', ['engine' => 'Aria']);
        $table->addColumn('id__Article', 'integer',['signed' => false])
            ->addColumn('id__Tag', 'integer', ['signed' => false])
            ->save();
    }

    public function down()
    {
        $this->dropTable('Article_Tag');
    }
}
