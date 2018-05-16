<?php

namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function getModelInstance();

    public function all()
    {
        return $this->getModelInstance()->all();
    }

    public function findById(int $id)
    {
        return $this->getModelInstance()->find($id);
    }

    public function findBySlug(string $slug)
    {
        return $this->getModelInstance()->where('slug', $slug)->first();
    }

    public function delete(int $id): void
    {
        $this->getModelInstance()->destroy($id);
    }

    public function getWith(array $with, string $orderField = '', string $orderDir = 'asc'): \Traversable
    {
        $result = $this->getModelInstance()->with($with);

        if ($orderField) {
            $result = $result->orderBy($orderField, $orderDir);
        }

        return $result->get();
    }

    public function create(array $data): int
    {
        $entity = $this->getModelInstance()->create($data);

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
