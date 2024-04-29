<?php

namespace App\Repositories\Common;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    abstract protected function getModelQB(): Builder;

    protected function getList(
        Builder $query
    ): Collection
    {
        return $query->get();
    }

    protected function getWithPaginate(
        Builder $query,
        ?int    $perPage = null,
        ?int    $page = null
    ): LengthAwarePaginator
    {
        return $query->paginate(
            perPage: $perPage ?? 10,
            page: $page ?? 1
        );
    }
}
