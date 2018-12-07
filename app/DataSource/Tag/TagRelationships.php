<?php
declare(strict_types=1);

namespace App\DataSource\Tag;

use App\DataSource\Article\Article;
use App\DataSource\ArticleTag\ArticleTag;
use Atlas\Mapper\MapperRelationships;

class TagRelationships extends MapperRelationships
{
    protected function define()
    {
        // the "through" relationship that joins articles and tags
        $this->oneToMany('Article_Tag', ArticleTag::class, [
            'id' => 'id__Tag'
        ]);

        // the "foreign" relationship "through" Article_Tag
        $this->manyToMany('articles', Article::class, 'Article_Tag');
    }
}
