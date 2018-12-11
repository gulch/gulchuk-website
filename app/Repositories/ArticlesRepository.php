<?php

namespace App\Repositories;

use App\DataSource\Article\Article;
use App\DataSource\Tag\Tag;

class ArticlesRepository extends BaseRepository
{
    public function articleTagsIdsArray(int $id): array
    {
        $article = $this->orm->fetchRecord($this->getMapperClassName(), $id, [
            'tags' => function ($articleTags) {
                $articleTags->columns('id');
            }
        ]);

        if (!$article) {
            return [];
        }

        $ids = [];
        foreach ($article->tags as $tag) {
            $ids[] = $tag->id;
        }

        return $ids;
    }

    public function getMapperClassName(): string
    {
        return Article::class;
    }

    public function getLatestPublished(): \Traversable
    {
        return $this->orm
            ->select($this->getMapperClassName())
            ->where('is_published = 1')
            ->orderBy('created_at DESC')
            ->fetchRecordSet();
    }

    public function getWithOptions(
        string $orderField,
        string $orderDir,
        int $limit,
        int $offset = 0
    ): \Traversable {
        return $this->orm
            ->select($this->getMapperClassName())
            ->limit($limit)
            ->offset($offset)
            ->orderBy($orderField . ' ' . $orderDir)
            ->fetchRecordSet();
    }

    public function syncTags(int $id, array $tags): void
    {
        $article = $this->findById($id, ['tags']);

        if (!$article) {
            return;
        }

        if ($article->tags) {
            $article->tags->detachAll();
            $this->orm->persist($article);
        }

        if (\count($tags)) {
            $tagsRecordSet = $this->orm->fetchRecordSet(Tag::class, $tags);
            $article->tags = $tagsRecordSet;
        }

        $this->orm->persist($article);
    }
}
