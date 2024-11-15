<?php

namespace App\Services\Auth\V1;

use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;

class RegistrationService extends Service
{
    public function handle(array $requestData): array
    {
        return $this->execute(function () use ($requestData) {
            $requestData['password'] = Hash::make($requestData['password']);
            $user = User::create($requestData);
            $token = $user->createToken('auth_token')->plainTextToken;
            return $this->successResponse('Registration successfully done!', [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        });
    }
}
