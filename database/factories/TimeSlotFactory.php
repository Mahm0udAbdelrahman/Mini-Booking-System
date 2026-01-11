<?php

namespace Database\Factories;

use App\Models\TimeSlot;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeSlotFactory extends Factory
{
    protected $model = TimeSlot::class;

    public function definition()
    {
        $start = $this->faker->dateTimeBetween('now', '+1 week');
        $end = (clone $start)->modify('+1 hour');

        return [
            'service_id' => Service::factory(),
            'date' => $start->format('Y-m-d'),
            'start_time' => $start,
            'end_time' => $end,
            'is_available' => true,
        ];
    }
}
