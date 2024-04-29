<?php

namespace App\Http\Controllers\Api;

use App\DTO\Category\CategoryCreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryCollection;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        public CategoryService $categoryService
    )
    {
    }

    public function index()
    {
        $serviceResult = $this->categoryService->getListCategories();

        return $this->createResponseFromServiceResult(
            serviceResult: $serviceResult,
            resource: CategoryCollection::class
        );
    }

    public function store(Request $request)
    {
        $serviceResult = $this->categoryService->create(
            categoryCreateDTO: CategoryCreateDTO::fillAttributes($request->all())
        );

        return $this->createResponseFromServiceResult(
            serviceResult: $serviceResult
        );
    }
}
