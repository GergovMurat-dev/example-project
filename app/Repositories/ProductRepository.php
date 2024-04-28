<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Common\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class ProductRepository extends BaseRepository
{

    function getModelQB(): Builder
    {
        return Product::query();
    }
}
