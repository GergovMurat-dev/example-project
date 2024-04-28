<?php

namespace App\Services\CRUD;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\CRUD\Common\BaseService;
use Illuminate\Database\Eloquent\Model;

class ProductServiceCRUD extends BaseService
{
    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getModelInstance(): Model
    {
        return new Product();
    }

    public function getValidateModelRules(array $properties): array
    {
        return [
            'title' => 'string|required|max:255',
            'description' => 'nullable|string|max:512',
            'price' => 'decimal:0,2'
        ];
    }
}
