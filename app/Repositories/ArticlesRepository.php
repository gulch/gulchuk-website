<?php

namespace App\Repositories;

use App\DataSource\Article\Article;

class ArticlesRepository extends BaseRepository
{
    public function getMapperClassName(): string
    {
        return Article::class;
    }

    public function getLatestPublished(): \Traversable
    {
        return $this->orm
            ->select($this->getMapperClassName())
            ->where('is_published = ', 1)
            ->orderBy('created_at DESC')
            ->fetchRecordSet();
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
