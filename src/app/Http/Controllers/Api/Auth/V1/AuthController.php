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
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // User Registration
    public function register(RegistrationRequest $request, RegistrationService $service)
    {
        $response = $service->handle($request);
        return response()->json($response);
    }

    // User Login
    public function login(LoginRequest $request, LoginService $service)
    {
        $response = $service->handle($request);
        return response()->json($response);
    }

    // User Logout
    public function logout(Request $request, LogoutService $service)
    {
        $response = $service->handle($request);
        return response()->json($response);
    }

    // Password Reset Link Sending
    public function sendPasswordResetLinkEmail(PasswordResetEmailRequest $request, PasswordResetEmailService $service)
    {
        $response = $service->handle($request);
        return response()->json($response);
    }

    // User Password Reset
    public function resetPassword(PasswordResetRequest $request, PasswordResetService $service)
    {
        $response = $service->handle($request);
        return response()->json($response);
    }
}
