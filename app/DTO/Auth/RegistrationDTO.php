<?php

namespace App\DTO\Auth;

use App\DTO\Common\BaseDTO;

class RegistrationDTO extends BaseDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?string $password = null
    )
    {
    }
}
