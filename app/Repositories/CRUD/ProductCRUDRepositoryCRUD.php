<?php

namespace App\Repositories\CRUD;

use App\Models\Product;
use App\Repositories\CRUD\Common\BaseCRUDRepository;
use Illuminate\Database\Eloquent\Builder;

class ProductCRUDRepositoryCRUD extends BaseCRUDRepository
{

    function getModelQB(): Builder
    {
        return Product::query();
    }
}
