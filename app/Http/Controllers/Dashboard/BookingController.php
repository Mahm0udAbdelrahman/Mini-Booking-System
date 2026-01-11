<?php
namespace App\Http\Controllers\Dashboard;

use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Services\Dashboard\BookingService;
use App\Http\Requests\Dashboard\User\BulkDeleteRequest;
use App\Http\Requests\Dashboard\Booking\UpdateBookingRequest;

class BookingController extends Controller
{

    public function __construct(public BookingService $bookingService)
    {}

    public function index()
    {
        $bookings = $this->bookingService->index();
        return view('dashboard.pages.booking.index', compact('bookings'));
    }
    public function create()
    {
        return view('dashboard.pages.booking.create');
    }

    public function show(Booking $booking)
    {
        return view('dashboard.pages.booking.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('dashboard.pages.booking.edit', compact('booking'));
    }

    public function update(Booking $booking, UpdateBookingRequest $updateBookingRequest)
    {

        $data = $updateBookingRequest->validated();
        $this->bookingService->update($booking, $data);
        Session::flash('message', ['type' => 'success', 'text' => __('Service updated successfully')]);
        return redirect()->route('Admin.booking.index');
    }

    public function destroy(Booking $booking)
    {
        $this->bookingService->destroy($booking);

        return redirect()->route('Admin.booking.index')->with('success', 'Service Successfully.');
    }


}
