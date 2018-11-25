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

    public function findById(int $id)
    {
        return $this->orm->fetchRecord(
            $this->getMapperClassName(),
            $id
        );
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





    /* TODO */
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

    public function delete(int $id): void
    {
        $this->getModelInstance()->destroy($id);
    }
}
