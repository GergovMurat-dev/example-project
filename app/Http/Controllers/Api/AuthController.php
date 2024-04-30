<?php

namespace App\Http\Controllers\Api;

use App\DTO\Auth\RegistrationDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Token\TokenResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function registration(Request $request)
    {
        $serviceResult = $this->authService->registration(
            registrationDTO: RegistrationDTO::fillAttributes($request->all())
        );

        return $this->createResponseFromServiceResult(
            serviceResult: $serviceResult,
            resource: TokenResource::class
        );
    }
}
