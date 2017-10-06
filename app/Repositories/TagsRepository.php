<?php

namespace App\Repositories;

use App\Models\Tag;

class TagsRepository extends BaseRepository
{
    public function __construct()
    {
        $this->modelName = Tag::class;
    }

    public function list(array $fields, string $orderField = '', string $orderDir = 'asc'): \Traversable
    {
        $list = ($this->modelName)::select($fields);

        if ($orderField) {
            $list = $list->orderBy($orderField, $orderDir);
        }

        return $list->get();
    }

    public function latestPublishedArticles(int $id): \Traversable
    {
        $tag = $this->findById($id);

        if (!sizeof($tag)) {
            return null;
        }

        return $tag->articles()->where('is_published', 1)->latest()->get();
    }

    public function syncArticles(int $id, array $articles): void
    {
        $tag = ($this->modelName)::find($id);

        if (sizeof($tag)) {
            $tag->articles()->sync($articles);
        }
    }
}