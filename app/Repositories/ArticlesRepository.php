<?php

namespace App\Repositories;

use App\Models\Article;

class ArticlesRepository extends BaseRepository
{
    public function getModelName()
    {
        return Article::class;
    }

    public function getLatestPublished(): \Traversable
    {
        return ($this->getModelName())::where('is_published', 1)->latest()->get();
    }

    public function getWithOptions(
        string $orderField,
        string $orderDir,
        int $limit,
        int $offset = 0
    ): \Traversable {
        return ($this->getModelName())::orderBy($orderField, $orderDir)->limit($limit)->offset($offset)->get();
    }

    public function syncTags(int $id, array $tags): void
    {
        $article = ($this->getModelName())::find($id);

        if (sizeof($article)) {
            $article->tags()->sync($tags);
        }
    }

    public function articleTagsIds(int $id): array
    {
        $article = ($this->getModelName())::find($id);

        if (!sizeof($article)) {
            return [];
        }

        return $article->tags->pluck('id')->toArray();
    }
}