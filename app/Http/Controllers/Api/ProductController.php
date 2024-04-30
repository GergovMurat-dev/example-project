<?php

namespace App\Http\Controllers\Api;

use App\DTO\Filter\ProductFilter;
use App\DTO\Paginate\PaginateDTO;
use App\DTO\Product\ProductCreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    )
    {
    }

    public function index(Request $request)
    {
        $serviceResult = $this->productService->getProductsWithPagination(
            productFilter: ProductFilter::fillAttributes($request->all()),
            paginateDTO: PaginateDTO::fillAttributes($request->all())
        );

        return $this->createResponseFromServiceResult(
            serviceResult: $serviceResult,
            resource: ProductCollection::class
        );
    }

    public function store(Request $request)
    {
        $serviceResult = $this->productService->create(
            productCreateDTO: ProductCreateDTO::fillAttributes($request->all())
        );

        return $this->createResponseFromServiceResult($serviceResult);
    }
}
