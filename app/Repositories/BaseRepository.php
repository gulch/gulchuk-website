<?php

namespace App\Repositories;

abstract class BaseRepository
{
    abstract public function getMapperClassName();

    /** @var \Atlas\Orm\Atlas */
    protected $orm;

    public function __construct($orm)
    {
        $this->orm = $orm;
    }

    public function all()
    {
        return $this->orm
            ->select($this->getMapperClassName())
            ->fetchRecordSet();
    }

    public function create(array $data): int
    {
        $entity = $this->orm->newRecord($this->getMapperClassName(), $data);

        $this->orm->insert($entity);

        return $entity->id ?? 0;
    }

    public function delete(int $id): void
    {
        $entity = $this->orm->fetchRecord($this->getMapperClassName(), $id);
        $this->orm->delete($entity);
    }

    public function findById(int $id, array $with = [])
    {
        $select = $this->orm
            ->select($this->getMapperClassName())
            ->where('id = ', $id);

        if (\count($with)) {
            $select = $select->with($with);
        }

        return $select->fetchRecord();
    }

    public function findBySlug(string $slug)
    {
        return $this->orm
            ->select($this->getMapperClassName())
            ->where('slug = ', $slug)
            ->fetchRecord();
    }

    public function getWith(
        array $with,
        string $orderField = '',
        string $orderDir = 'ASC'
    ): \Traversable {

        $result = $this->orm
            ->select($this->getMapperClassName())
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
