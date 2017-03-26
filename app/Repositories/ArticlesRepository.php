<?php

namespace Gulchuk\Repositories;

use Gulchuk\Models\Article;

class ArticlesRepository extends BaseRepository
{
    public function __construct()
    {
        $this->modelName = Article::class;
    }

    public function syncTags(int $id, array $tags): void
    {
        $article = ($this->modelName)::find($id);

        if (sizeof($article)) {
            $article->tags()->sync($tags);
        }
    }

    public function articleTagsIds(int $id): array
    {
        $article = ($this->modelName)::find($id);

        if (!sizeof($article)) {
            return [];
        }

        return $article->tags->pluck('id')->toArray();
    }
}