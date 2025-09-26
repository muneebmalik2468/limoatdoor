<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pickup_location',
        'dropoff_location',
        'pickup_datetime',
        'passengers',
        'luggage',
        'vehicle_id',
        'estimated_hours',
        'iatan_account',
        'ta_fee',
        'with_pet',
        'notes',
        'status',
        'guest_email',
        'trip_type',
        'phone',
        'distance_in_miles',
        'duration_in_minutes',
        'price',
        'vehicle_count',
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'with_pet' => 'boolean',
        'trip_type' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}