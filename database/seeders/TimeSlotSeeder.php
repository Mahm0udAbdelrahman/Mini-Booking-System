<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::first();

        for ($i = 1; $i <= 5; $i++) {
            TimeSlot::create([
                'service_id' => $service->id,
                'date' => now()->addDays($i)->toDateString(),
                'start_time' => Carbon::now()->addDays($i)->setHour(10),
                'end_time' => Carbon::now()->addDays($i)->setHour(11),
                'is_available' => true,
            ]);
        }
    }
}
