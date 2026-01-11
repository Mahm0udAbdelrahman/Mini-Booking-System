<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();
        $timeSlot = TimeSlot::where('is_available', true)->first();

        Booking::create([
            'user_id' => $customer->id,
            'service_id' => $timeSlot->service_id,
            'time_slot_id' => $timeSlot->id,
            'status' => 'confirmed',
            'price' => $timeSlot->service->price,
        ]);

        $timeSlot->update(['is_available' => false]);
    }
}
