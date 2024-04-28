<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Model;

    public function getModelQB(): Builder;
}
