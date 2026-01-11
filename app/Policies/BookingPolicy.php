<?php
namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{

    public function viewAnyDashboard(User $user)
    {
        return $user->isProvider() || $user->isAdmin();
    }

    public function view(User $user, Booking $booking)
    {
        return $user->isAdmin()
        || $booking->service->provider_id === $user->id;
    }

    public function create(User $user)
    {
        return $user->isCustomer();
    }

    public function update(User $user, Booking $booking)
    {
        return $user->isAdmin()
        || $booking->service->provider_id === $user->id;
    }

    public function delete(User $user, Booking $booking)
    {
        return $user->isAdmin()
        || $booking->service->provider_id === $user->id;
    }

    public function statistics(User $user, Booking $booking)
    {
        return $user->isAdmin()
        || $booking->service->provider_id === $user->id;
    }
}
