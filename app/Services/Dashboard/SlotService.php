<?php
namespace App\Services\Api;

use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Validation\ValidationException;

class SlotService
{
    public function index()
    {
        
    }
    public function create(Service $service, array $data): TimeSlot
    {
        $overlap = TimeSlot::where('service_id', $service->id)
            ->where('date', $data['date'])
            ->where(function ($q) use ($data) {
                $q->where('start_time', '<', $data['end_time'])
                    ->where('end_time', '>', $data['start_time']);
            })->exists();

        if ($overlap) {
            throw ValidationException::withMessages([
                'slot' => 'Overlapping time slot',
            ]);
        }

        return TimeSlot::create([
            'service_id' => $service->id,
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'is_available' => true,
        ]);
    }
}
