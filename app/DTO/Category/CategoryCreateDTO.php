<?php

namespace App\DTO\Category;

use App\DTO\Common;

class CategoryCreateDTO extends Common\BaseDTO
{
    public function __construct(
        public ?string $title = null,
        public ?int    $order = null,
        public ?bool   $isActive = null,
        public ?int    $parentId = null
    )
    {
    }
}
