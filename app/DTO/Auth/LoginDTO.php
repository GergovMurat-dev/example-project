<?php

namespace App\DTO\Auth;

use App\DTO\Common\BaseDTO;

class LoginDTO extends BaseDTO
{
    public function __construct(
        public ?string $email = null,
        public ?string $password = null
    )
    {
    }
}
