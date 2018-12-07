<?php
declare(strict_types=1);

namespace App\DataSource\Article;

use App\DataSource\ArticleTag\ArticleTag;
use App\DataSource\Tag\Tag;
use Atlas\Mapper\MapperRelationships;

class ArticleRelationships extends MapperRelationships
{
    protected function define()
    {
        $this->oneToMany('Article_Tag', ArticleTag::class, [
            'id' => 'id__Article'
        ]);

        $this->manyToMany('tags', Tag::class, 'Article_Tag');
    }
}
