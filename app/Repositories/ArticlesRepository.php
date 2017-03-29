<?php

namespace Gulchuk\Repositories;

use Gulchuk\Models\Article;

class ArticlesRepository extends BaseRepository
{
    public function __construct()
    {
        $this->modelName = Article::class;
    }

    public function getLatestPublished(): \Traversable
    {
        return ($this->modelName)::where('is_published', 1)->latest()->get();
    }

    public function getWithOptions(
        string $orderField,
        string $orderDir,
        int $limit,
        int $offset = 0
    ): \Traversable {
        return ($this->modelName)::orderBy($orderField, $orderDir)->limit($limit)->offset($offset)->get();
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