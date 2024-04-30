<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function getByHash(string $hash): ?User
    {
        /** @var User $user */
        $user = $this->userRepository->getByHash($hash);

        return $user;
    }
}
