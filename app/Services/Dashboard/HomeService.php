<?php

namespace App\Services\Dashboard;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeService
{
    protected function bookingsQuery()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return Booking::query();
        }

        if ($user->isProvider()) {
            return Booking::whereHas('service', function ($q) use ($user) {
                $q->where('provider_id', $user->id);
            });
        }

        return Booking::query()->whereRaw('1 = 0');
    }

    public function getStatistics(): array
    {
        $query = $this->bookingsQuery();

        return [
            'totalBookings' => $query->count(),

            'bookingsByStatus' => (clone $query)
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status'),

            'total' => (clone $query)->sum('price'),

            'totalPending' => (clone $query)
                ->where('status', 'pending')
                ->sum('price'),

            'totalConfirmed' => (clone $query)
                ->where('status', 'confirmed')
                ->sum('price'),

            'totalCancelled' => (clone $query)
                ->where('status', 'cancelled')
                ->sum('price'),

            'dailyRevenue' => (clone $query)
                ->whereDate('created_at', today())
                ->where('status', 'confirmed')
                ->sum('price'),

            'monthlyRevenue' => (clone $query)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->where('status', 'confirmed')
                ->sum('price'),

            'yearlyRevenue' => (clone $query)
                ->whereYear('created_at', now()->year)
                ->where('status', 'confirmed')
                ->sum('price'),
        ];
    }
}
