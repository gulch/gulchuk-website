<?php

namespace Gulchuk\Repositories;


use Illuminate\Database\Events\TransactionBeginning;

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

    public function create(array $data): bool
    {
        $entity = ($this->modelName)::create($data);

        return isset($entity->id) ? true : false;
    }
}