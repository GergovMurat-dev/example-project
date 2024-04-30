<?php

namespace App\DTO\Product;

use App\DTO\Common\BaseDTO;

class ProductCreateDTO extends BaseDTO
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?string $price = null,
        public ?int    $categoryId = null
    )
    {
    }
}
