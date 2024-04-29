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
        ?int $perPage = null,
        ?int $page = null
    ): LengthAwarePaginator
    {
        $query = $this->getModelQB();

        return $this->getWithPaginate(
            query: $query,
            perPage: $perPage,
            page: $page
        );
    }
}
