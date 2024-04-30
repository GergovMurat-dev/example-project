<?php

namespace App\DTO\Filter;

use App\DTO\Common\BaseDTO;

class ProductFilter extends BaseDTO
{
    public function __construct(
        public ?array $categories = null
    )
    {
    }
}
