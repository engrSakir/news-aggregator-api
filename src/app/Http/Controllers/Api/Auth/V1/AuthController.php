<?php

namespace App\Http\Controllers\Api\Auth\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\V1\LoginRequest;
use App\Http\Requests\Auth\V1\PasswordResetEmailRequest;
use App\Http\Requests\Auth\V1\PasswordResetRequest;
use App\Http\Requests\Auth\V1\RegistrationRequest;
use App\Services\Auth\V1\LoginService;
use App\Services\Auth\V1\LogoutService;
use App\Services\Auth\V1\PasswordResetEmailService;
use App\Services\Auth\V1\PasswordResetService;
use App\Services\Auth\V1\RegistrationService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle($request->validated())
        );
    }

    public function register(RegistrationRequest $request, RegistrationService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle($request->validated())
        );
    }

    public function logout(LogoutService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle()
        );
    }

    public function sendPasswordResetLinkEmail(PasswordResetEmailRequest $request, PasswordResetEmailService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle($request->validated())
        );
    }

    public function resetPassword(PasswordResetRequest $request, PasswordResetService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle($request->validated())
        );
    }
}
