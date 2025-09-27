<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'passenger_capacity',
        'luggage_capacity',
        'description',
        'base_rate',
        'hourly_rate',
        'fixed_rate',
        'is_available',
        'image',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
