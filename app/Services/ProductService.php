<?php

namespace App\Services;

use App\DTO\Paginate\PaginateDTO;
use App\DTO\Product\ProductCreateDTO;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\Common\ServiceResult;
use App\Services\CRUD\ProductServiceCRUD;

class ProductService
{
    public function __construct(
        public ProductServiceCRUD $productServiceCRUD,
        public ProductRepository  $productRepository
    )
    {
    }

    public function create(ProductCreateDTO $productCreateDTO): ServiceResult
    {
        $productCreateServiceResult = $this->productServiceCRUD->create($productCreateDTO->toArrayAsSnakeCase());

        if ($productCreateServiceResult->isError) {
            return $productCreateServiceResult;
        }

        /** @var Product $product */
        $product = $productCreateServiceResult->data;

        return ServiceResult::createSuccessResult($product);
    }

    public function getProductsWithPagination(
        PaginateDTO $paginateDTO
    ): ServiceResult
    {
        return ServiceResult::createSuccessResult(
            $this->productRepository->getProductsWithPaginate(
                perPage: $paginateDTO->perPage,
                page: $paginateDTO->page
            )
        );
    }
}
