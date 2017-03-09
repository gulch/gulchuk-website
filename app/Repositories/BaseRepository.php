<?php

namespace Gulchuk\Repositories;


abstract class BaseRepository
{
    protected $modelName;

    public function all()
    {
        return ($this->modelName)::all();
    }

    public function findById(int $id)
    {
        return ($this->modelName)::find($id)->first();
    }

    public function findBySlug(string $slug)
    {
        return ($this->modelName)::where('slug', $slug)->first();
    }

    public function delete(int $id): void
    {
        ($this->modelName)::destroy($id);
    }

    public function getWith(array $with, string $orderField = '', string $orderDir = 'asc'): \Traversable
    {
        $result = ($this->modelName)::with($with);

        if ($orderField) {
            $result = $result->orderBy($orderField, $orderDir);
        }

        return $result->get();
    }
}