<?php

namespace App\Services;

use App\DTO\Auth\RegistrationDTO;
use App\Models\User;
use App\Services\Common\ServiceResult;
use App\Services\CRUD\UserServiceCRUD;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function __construct(
        private readonly UserServiceCRUD $userServiceCRUD
    )
    {
    }

    public function registration(RegistrationDTO $registrationDTO): ServiceResult
    {
        $credentials = $registrationDTO->toArrayAsSnakeCase();

        DB::beginTransaction();

        $userCreateServiceResult = $this->userServiceCRUD->create($credentials);

        if ($userCreateServiceResult->isError) {
            DB::rollBack();
            return $userCreateServiceResult;
        }

        DB::commit();

        /** @var User $user */
        $user = $userCreateServiceResult->data;
        $token = $user->createToken('auth')->plainTextToken;

        return ServiceResult::createSuccessResult(['token' => $token]);
    }
}
