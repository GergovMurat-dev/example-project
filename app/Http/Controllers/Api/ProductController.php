<?php

namespace App\Http\Controllers\Api;

use App\DTO\Product\ProductCreateDTO;
use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    )
    {
    }

    public function store(Request $request)
    {
        $serviceResult = $this->productService->create(
            ProductCreateDTO::fillAttributes($request->all())
        );

        return $this->createResponseFromServiceResult($serviceResult);
    }
}
