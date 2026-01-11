<?php
namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Service;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_prevent_double_booking_for_same_time_slot()
    {
        $service  = Service::factory()->create();
        $timeSlot = TimeSlot::factory()->create(['service_id' => $service->id]);

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Booking::create([
            'user_id'      => $user1->id,
            'service_id'   => $service->id,
            'time_slot_id' => $timeSlot->id,
            'price'        => $service->price,
            'status'       => 'pending',
        ]);

        $this->expectException(\Exception::class);

        Booking::create([
            'user_id'      => $user2->id,
            'service_id'   => $service->id,
            'time_slot_id' => $timeSlot->id,
            'price'        => $service->price,
            'status'       => 'pending',
        ]);
    }
}
