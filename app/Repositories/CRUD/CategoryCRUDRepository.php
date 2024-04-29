<?php

namespace App\Repositories\CRUD;

use App\Models\Category;
use App\Repositories\CRUD\Common\BaseCRUDRepository;
use Illuminate\Database\Eloquent\Builder;

class CategoryCRUDRepository extends BaseCRUDRepository
{

    function getModelQB(): Builder
    {
        return Category::query();
    }
}
