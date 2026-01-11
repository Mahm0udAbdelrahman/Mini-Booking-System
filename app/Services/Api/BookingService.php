<?php
namespace App\Services\Api;

use App\Models\User;
use App\Models\Booking;
use App\Models\TimeSlot;
use App\Jobs\SendBookingMailJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingService
{
    public function create(User $user, int $slotId): Booking
    {
        return DB::transaction(function () use ($user, $slotId) {

            $slot = TimeSlot::where('id', $slotId)
                ->lockForUpdate()
                ->firstOrFail();

            if (!$slot->is_available) {
                throw ValidationException::withMessages([
                    'slot' => 'This slot is already booked'
                ]);
            }

            $booking = Booking::create([
                'user_id' => $user->id,
                'service_id' => $slot->service_id,
                'time_slot_id' => $slot->id,
                'status' => Booking::PENDING,
                'price' => $slot->service->price
            ]);

            $slot->update(['is_available' => false]);

            SendBookingMailJob::dispatch($booking);

            return $booking;
        });
    }
}
