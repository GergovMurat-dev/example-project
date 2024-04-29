<?php

namespace App\DTO\Paginate;

use App\DTO\Common\BaseDTO;

class PaginateDTO extends BaseDTO
{
    public function __construct(
        public ?int $page = null,
        public ?int $perPage = null
    )
    {
    }
}
