<?php

namespace App\Repositories;

use App\DataSource\Article\Article;
use App\DataSource\Tag\Tag;

class TagsRepository extends BaseRepository
{
    public function getMapperClassName(): string
    {
        return Tag::class;
    }

    public function list(
        array $fields,
        string $orderField = 'id',
        string $orderDir = 'ASC'
    ): iterable {
        $list = $this->orm
            ->select($this->getMapperClassName())
            ->columns('id', ...$fields)
            ->orderBy($orderField . ' ' . $orderDir);

        return $list->fetchRecords();
    }

    public function latestPublishedArticles(int $id): \Traversable
    {
        $tag = $this->orm->fetchRecord(
            $this->getMapperClassName(),
            $id,
            [
                'articles' => function ($tagArticles) {
                    $tagArticles->where('is_published = 1')
                        ->orderBy('created_at DESC');
                }
            ]
        );

        return $tag->articles;
    }

    public function syncArticles(int $id, array $articles): void
    {
        $tag = $this->findById($id, ['articles']);

        if (!$tag) {
            return;
        }

        if ($tag->articles) {
            $tag->articles->detachAll();
            $this->orm->persist($tag);
        }

        if (\count($articles)) {
            $articlesRecordSet = $this->orm->fetchRecordSet(Article::class, $articles);
            $tag->articles = $articlesRecordSet;
            $this->orm->persist($tag);
        }
    }
}
