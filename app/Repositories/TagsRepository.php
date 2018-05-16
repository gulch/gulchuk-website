<?php

namespace App\Repositories;

use App\Models\Tag;

class TagsRepository extends BaseRepository
{
    public function getModelInstance(): Tag
    {
        return new Tag();
    }

    public function list(array $fields, string $orderField = '', string $orderDir = 'asc'): \Traversable
    {
        $list = $this->getModelInstance()->select($fields);

        if ($orderField) {
            $list = $list->orderBy($orderField, $orderDir);
        }

        return $list->get();
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
