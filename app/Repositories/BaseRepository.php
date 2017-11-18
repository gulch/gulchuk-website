<?php

namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function getModelName();

    public function all()
    {
        return ($this->getModelName())::all();
    }

    public function findById(int $id)
    {
        return ($this->getModelName())::find($id);
    }

    public function findBySlug(string $slug)
    {
        return ($this->getModelName())::where('slug', $slug)->first();
    }

    public function delete(int $id): void
    {
        ($this->getModelName())::destroy($id);
    }

    public function getWith(array $with, string $orderField = '', string $orderDir = 'asc'): \Traversable
    {
        $result = ($this->getModelName())::with($with);

        if ($orderField) {
            $result = $result->orderBy($orderField, $orderDir);
        }

        return $result->get();
    }

    public function create(array $data): int
    {
        $entity = ($this->getModelName())::create($data);

        return $entity->id ?? 0;
    }

    public function update(int $id, array $data): bool
    {
        $entity = $this->findById($id);

        if (!$entity) {
            return false;
        }

        return $entity->update($data);
    }
}
