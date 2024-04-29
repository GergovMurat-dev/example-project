<?php

namespace App\Services\CRUD;

use App\Models\Category;
use App\Repositories\CRUD\CategoryCRUDRepository;
use Illuminate\Database\Eloquent\Model;

class CategoryServiceCRUD extends Common\BaseService
{
    public function __construct(CategoryCRUDRepository $repository)
    {
        parent::__construct($repository);
    }

    public function getModelInstance(): Model
    {
        return new Category();
    }

    public function getValidateModelRules(array $properties): array
    {
        return [
            'title' => 'required|unique:categories,title',
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }
}
