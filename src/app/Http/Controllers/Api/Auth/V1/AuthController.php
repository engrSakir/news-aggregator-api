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
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param RegistrationRequest $request
     * @param RegistrationService $service
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request, RegistrationService $service): JsonResponse
    {
        $registerResponse = $service->handle($request);
        return response()->json($registerResponse);
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request, LoginService $service): JsonResponse|ValidationException
    {
        $loginResponse = $service->handle($request);
        return response()->json($loginResponse);
    }

    /**
     * @param Request $request
     * @param LogoutService $service
     * @return JsonResponse
     */
    public function logout(Request $request, LogoutService $service): JsonResponse
    {
        $logoutResponse = $service->handle($request);
        return response()->json($logoutResponse);
    }

    /**
     * @param PasswordResetEmailRequest $request
     * @param PasswordResetEmailService $service
     * @return JsonResponse
     */
    public function sendPasswordResetLinkEmail(PasswordResetEmailRequest $request, PasswordResetEmailService $service): JsonResponse
    {
        $resetLinkResponse = $service->handle($request);
        return response()->json($resetLinkResponse);
    }

    /**
     * @param PasswordResetRequest $request
     * @param PasswordResetService $service
     * @return JsonResponse
     */
    public function resetPassword(PasswordResetRequest $request, PasswordResetService $service): JsonResponse
    {
        $resetPasswordResponse = $service->handle($request);
        return response()->json($resetPasswordResponse);
    }
}
