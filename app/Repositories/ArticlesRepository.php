<?php

namespace Gulchuk\Repositories;

use Gulchuk\Models\Article;

class ArticlesRepository extends BaseRepository
{
    public function __construct()
    {
        $this->modelName = Article::class;
    }

    public function syncArticles(int $id, array $tags): void
    {
        $article = ($this->modelName)::find($id);

        if (sizeof($article)) {
            $article->tags()->sync($tags);
        }
    }
}