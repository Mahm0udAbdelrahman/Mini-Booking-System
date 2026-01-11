<?php
namespace App\Services\Dashboard;

use App\Models\Booking;

class BookingService
{
    public function __construct(public Booking $model)
    {}

    public function index()
    {
        return $this->model->paginate(10);
    }

    public function update($booking, array $data)
    {

        $booking->update($data);

        return $booking;
    }

    public function destroy($booking)
    {
        $booking->delete();

        return $booking;
    }

}
