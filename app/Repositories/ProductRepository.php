<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Common\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository
{
    protected function getModelQB(): Builder
    {
        return Product::query();
    }

    public function getProductsWithPaginate(
        ?array $categories = null,
        ?int   $perPage = null,
        ?int   $page = null
    ): LengthAwarePaginator
    {
        $query = $this->getModelQB();

        if ($categories) {
            $this->queryByCategories(
                query: $query,
                categories: $categories
            );
        }

        $this->querySortByCategory($query);

        return $this->getWithPaginate(
            query: $query,
            perPage: $perPage,
            page: $page
        );
    }

    private function querySortByCategory(
        Builder $query,
        string  $orderBy = 'desc'
    ): void
    {
        $query
            ->leftJoin('categories', 'categories.id', '=', 'products.id')
            ->orderBy('category_order', $orderBy);

        $this->filterIncomeValues($query);
    }

    private function filterIncomeValues(
        Builder $query
    )
    {
        $query->select(
            'products.*',
            'categories.order as category_order'
        );
    }

    private function queryByCategories(
        Builder $query,
        array   $categories
    ): void
    {
        $query->whereIn('category_id', $categories);
    }
}
