<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const PENDING   = 'pending';
    const CONFIRMED = 'confirmed';
    const CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'service_id',
        'time_slot_id',
        'status',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function slot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id');
    }
}
