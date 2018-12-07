<?php
declare(strict_types=1);

namespace App\DataSource\ArticleTag;

use App\DataSource\Article\Article;
use App\DataSource\Tag\Tag;
use Atlas\Mapper\MapperRelationships;

class ArticleTagRelationships extends MapperRelationships
{
    protected function define()
    {
        // the article side of the association mapping
        $this->manyToOne('articles', Article::class, [
            'id__Article' => 'id'
        ]);

        // the tags side of the association mapping
        $this->manyToOne('tags', Tag::class, [
            'id__Tag' => 'id'
        ]);
    }
}
