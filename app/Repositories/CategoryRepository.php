<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Common\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository
{

    protected function getModelQB(): Builder
    {
        return Category::query();
    }

    public function getListCategories(
        string $orderBy = 'asc'
    ): Collection
    {
        $query = $this->getModelQB();

        $this->defaultFilter(
            query: $query,
            orderBy: $orderBy
        );

        return $this->getList(
            query: $query
        );
    }

    private function defaultFilter(
        Builder $query,
        string  $orderBy = 'asc'
    ): void
    {
        $this->zoningRootCategories(query: $query);
        $this->queryIsActive(query: $query);
        $this->loadChildren(
            query: $query,
            orderBy: $orderBy
        );
        $this->querySort(
            query: $query,
            orderBy: $orderBy
        );
    }

    private function querySort(
        Builder $query,
        string  $orderBy = 'asc'
    ): void
    {
        $query->orderBy('order', $orderBy);
    }

    private function loadChildren(
        Builder $query,
        string  $orderBy = 'asc'
    ): void
    {
        $query
            ->with('children', function (HasMany $query) use ($orderBy) {
                $query
                    ->orderBy('order', $orderBy)
                    ->where('is_active', true);
            });
    }

    private function zoningRootCategories(
        Builder $query
    ): void
    {
        $query->whereNull('parent_id');
    }

    private function queryIsActive(
        Builder $query
    ): void
    {
        $query->where('is_active', true);
    }
}
