<?php

namespace App\Services\Auth\V1;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    public function handle($request)
    {
        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
