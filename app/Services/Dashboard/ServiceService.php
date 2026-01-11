<?php
namespace App\Services\Dashboard;

use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\DB;

class ServiceService
{
    public function __construct(public Service $model)
    {}

    public function index()
    {
        return $this->model->withTrashed()->paginate(10);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $service = Service::create([
                'name'        => $data['name'],
                'price'       => $data['price'],
                'provider_id' => auth()->id(),

            ]);

            foreach ($data['time_slots'] as $slot) {

                TimeSlot::create([
                    'service_id'   => $service->id,
                    'date'         => $slot['date'],
                    'start_time'   => $slot['start_time'],
                    'end_time'     => $slot['end_time'],
                    'is_available' => true,
                ]);
            }

            return $service;
        });
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($service, array $data)
    {

        return DB::transaction(function () use ($service, $data) {

            $service->update([
                'name'  => $data['name'],
                'price' => $data['price'],
            ]);

            $incomingIds = collect($data['time_slots'])
                ->pluck('id')
                ->filter()
                ->toArray();

            $service->timeSlots()
                ->whereNotIn('id', $incomingIds)
                ->delete();

            foreach ($data['time_slots'] as $slot) {

                if (! empty($slot['id'])) {
                    TimeSlot::where('id', $slot['id'])->update([
                        'date'       => $slot['date'],
                        'start_time' => $slot['start_time'],
                        'end_time'   => $slot['end_time'],
                    ]);
                } else {
                    TimeSlot::create([
                        'service_id'   => $service->id,
                        'date'         => $slot['date'],
                        'start_time'   => $slot['start_time'],
                        'end_time'     => $slot['end_time'],
                        'is_available' => true,
                    ]);
                }
            }

            return $service;
        });
    }

    public function destroy($service)
    {

        $service->delete();

        return $service;
    }

    public function restore($id)
    {
        $service = $this->model->onlyTrashed()->findOrFail($id);
        $service->restore();
        return $service;
    }

    public function forceDelete($id)
    {
        $service = $this->model->onlyTrashed()->findOrFail($id);
        $service->forceDelete();
        return $service;
    }

}
