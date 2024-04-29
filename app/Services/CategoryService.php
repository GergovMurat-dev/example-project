<?php

namespace App\Services;

use App\DTO\Category\CategoryCreateDTO;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\Common\ServiceResult;
use App\Services\CRUD\CategoryServiceCRUD;

class CategoryService
{
    public function __construct(
        private CategoryServiceCRUD $categoryServiceCRUD,
        private CategoryRepository  $categoryRepository
    )
    {
    }

    public function getListCategories(): ServiceResult
    {
        return ServiceResult::createSuccessResult(
            $this->categoryRepository->getListCategories()
        );
    }

    public function create(CategoryCreateDTO $categoryCreateDTO): ServiceResult
    {
        $categoryCreateServiceResult = $this->categoryServiceCRUD->create($categoryCreateDTO->toArrayAsSnakeCase());

        if ($categoryCreateServiceResult->isError) {
            return $categoryCreateServiceResult;
        }

        /** @var Category $category */
        $category = $categoryCreateServiceResult->data;

        return ServiceResult::createSuccessResult($category);
    }
}
