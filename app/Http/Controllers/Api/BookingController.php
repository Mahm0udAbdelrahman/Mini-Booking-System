<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Booking\StoreBookingRequest;
use App\Models\Booking;
use App\Services\Api\BookingService;
use App\Traits\HttpResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use HttpResponse, AuthorizesRequests;
    public function __construct(public BookingService $bookingService)
    {}

    public function store(StoreBookingRequest $request)
    {
        $this->authorize('create', Booking::class);

        $booking = $this->bookingService->create(auth()->user(),$request->time_slot_id);

        return $this->okResponse('', 'Booking Successfully');
    }

}
