<?php

namespace App\Services;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegistrationDTO;
use App\DTO\Mail\MailDTO;
use App\Mail\ConfirmationUserMail;
use App\Models\User;
use App\Services\Common\ServiceResult;
use App\Services\CRUD\UserServiceCRUD;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthService
{
    public function __construct(
        private readonly UserServiceCRUD $userServiceCRUD,
        private readonly MailService     $mailService
    )
    {
    }

    public function registration(RegistrationDTO $registrationDTO): ServiceResult
    {
        $credentials = $registrationDTO->toArrayAsSnakeCase();

        $credentials['confirmation_hash'] = $this->generateHash();

        DB::beginTransaction();

        $userCreateServiceResult = $this->userServiceCRUD->create($credentials);

        if ($userCreateServiceResult->isError) {
            DB::rollBack();
            return $userCreateServiceResult;
        }

        /** @var User $user */
        $user = $userCreateServiceResult->data;

        $mailSendService = $this->mailService->send(
            new MailDTO(
                $user->email,
                new ConfirmationUserMail($user->confirmation_hash)
            )
        );

        if ($mailSendService->isError) {
            DB::rollBack();
            return $mailSendService;
        }

        DB::commit();

        $token = $user->createToken('auth')->plainTextToken;

        return ServiceResult::createSuccessResult(['token' => $token]);
    }

    public function login(LoginDTO $loginDTO): ServiceResult
    {
        $credentials = $loginDTO->toArrayAsSnakeCase();

        if (!Auth::attempt($credentials)) {
            return ServiceResult::createErrorResult(
                'Логин или пароль неверный'
            );
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('auth')->plainTextToken;

        return ServiceResult::createSuccessResult(['token' => $token]);
    }

    private function generateHash(): string
    {
        $hash = hash('sha256', Str::random());

        $validator = Validator::make(['hash' => $hash],
            [
                'hash' => 'required|unique:users,confirmation_hash'
            ]
        );

        if ($validator->fails()) {
            return $this->generateHash();
        }

        return $hash;
    }
}
