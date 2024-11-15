<?php

namespace App\Services\Auth\V1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    /**
     * @param $request
     * @return array
     */
    public function handle($request): array
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
