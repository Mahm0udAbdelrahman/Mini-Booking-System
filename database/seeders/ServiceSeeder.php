<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $provider = User::where('role', 'provider')->first();

        Service::create([
            'provider_id' => $provider->id,
            'name' => 'General Consultation',
            'price' => 100,
        ]);

        Service::create([
            'provider_id' => $provider->id,
            'name' => 'Premium Consultation',
            'price' => 200,
        ]);
    }
}
