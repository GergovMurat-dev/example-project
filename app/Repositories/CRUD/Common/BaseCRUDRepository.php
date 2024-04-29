<?php

namespace App\Repositories\CRUD\Common;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseCRUDRepository implements RepositoryInterface
{
    public function getAll(): Collection
    {
        return $this->getModelQB()->get();
    }

    public function getById(int $id): ?Model
    {
        return $this->getModelQB()->find($id);
    }

    abstract function getModelQB(): Builder;
}
