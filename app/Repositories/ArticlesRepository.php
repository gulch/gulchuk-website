<?php

namespace App\Repositories;

use App\Models\Article;

class ArticlesRepository extends BaseRepository
{
    public function getModelInstance(): Article
    {
        return new Article();
    }

    public function getLatestPublished(): \Traversable
    {
        return $this->getModelInstance()
            ->where('is_published', 1)
            ->latest()
            ->get();
    }

    public function getWithOptions(
        string $orderField,
        string $orderDir,
        int $limit,
        int $offset = 0
    ): \Traversable {
        return $this->getModelInstance()
            ->orderBy($orderField, $orderDir)
            ->limit($limit)
            ->offset($offset)
            ->get();
    }

    public function syncTags(int $id, array $tags): void
    {
        $article = $this->findById($id);

        if ($article) {
            $article->tags()->sync($tags);
        }
    }

    public function articleTagsIds(int $id): array
    {
        $article = $this->findById($id);

        if (!$article) {
            return [];
        }

        return $article->tags->pluck('id')->toArray();
    }
}
