<?php

namespace App\Services\Auth\V1;

use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;

class LoginService extends Service
{
    public function handle(array $requestData): array
    {
        return $this->execute(function () use ($requestData) {
            $user = User::where('email', $requestData['email'])->first();
            if (!$user || !Hash::check($requestData['password'], $user->password)) {
                return $this->errorResponse('The provided credentials are incorrect.', 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->successResponse('Logged in successfully.',  [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        });
    }
}
