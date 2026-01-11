<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use SoftDeletes , HasFactory;


    protected $fillable = ['name', 'price', 'provider_id'];

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }
}
