<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'provider_id' => User::factory(),  
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
