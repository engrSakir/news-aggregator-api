<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's users.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => "Mr. User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('secret'),
            ]);
        }
    }
}
