<?php

namespace App\DTO\Product;

use App\DTO\Common\BaseDTO;

class ProductCreateDTO extends BaseDTO
{
    public function __construct(
        public ?string $title,
        public ?string $description,
        public ?string $price
    )
    {
    }
}
