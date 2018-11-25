<?php

namespace App\Repositories;

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
        $tag = $this->findById($id);

        if (!$tag) {
            return null;
        }

        return $tag->articles()->where('is_published', 1)->latest()->get();
    }

    public function syncArticles(int $id, array $articles): void
    {
        $tag = $this->findById($id);

        if ($tag) {
            $tag->articles()->sync($articles);
        }
    }
}
