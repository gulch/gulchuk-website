<?php

namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function getModelClassName();

    public function __construct()
    {
        //
    }

    public function all(): iterable
    {
        return ($this->getModelClassName())::query()->all();
    }

    public function create(array $data): int
    {
        $entity = $this->orm->newRecord($this->getModelClassName(), $data);

        $this->orm->insert($entity);

        return $entity->id ?? 0;
    }

    public function delete(int $id): void
    {
        $entity = $this->orm->fetchRecord($this->getModelClassName(), $id);
        $this->orm->delete($entity);
    }

    public function findById(int $id, array $with = []): object
    {
        $select = ($this->getModelClassName())::query()
            ->where('id', $id);

        if (\count($with)) {
            $select = $select->with($with);
        }

        return $select->first();
    }

    public function findBySlug(string $slug): object
    {
        return $this->orm
            ->select($this->getModelClassName())
            ->where('slug = ', $slug)
            ->fetchRecord();
    }

    public function getWith(
        array $with,
        string $orderField = '',
        string $orderDir = 'ASC'
    ): \Traversable {
        $result = $this->orm
            ->select($this->getModelClassName())
            ->with($with);

        if ($orderField) {
            $result = $result->orderBy($orderField . ' ' . $orderDir);
        }

        return $result->fetchRecordSet();
    }

    public function update(int $id, array $data): bool
    {
        $entity = $this->findById($id);

        if (!$entity) {
            return false;
        }

        $entity->set($data);

        $this->orm->update($entity);

        return true;
    }
}
