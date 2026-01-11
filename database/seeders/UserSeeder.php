<?php
namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role'     => UserType::ADMIN->value,
        ]);

        User::create([
            'name'     => 'Provider User',
            'email'    => 'provider@test.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role'     => UserType::PROVIDER->value,
        ]);

        User::factory()->count(5)->create([
            'role' => UserType::CUSTOMER->value,
        ]);
    }
}
