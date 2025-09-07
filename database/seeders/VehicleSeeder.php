<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'name' => 'Luxury Sedan',
            'type' => 'sedan',
            'passenger_capacity' => 4,
            'luggage_capacity' => 2,
            'description' => 'Comfortable sedan for small groups.',
            'base_rate' => 50.00,
            'is_available' => true,
            'image' => 'vehicles/sedan.png',
        ]);

        Vehicle::create([
            'name' => 'Executive SUV',
            'type' => 'suv',
            'passenger_capacity' => 6,
            'luggage_capacity' => 4,
            'description' => 'Spacious SUV for larger groups.',
            'base_rate' => 75.00,
            'is_available' => true,
            'image' => 'vehicles/suv.png',
        ]);

        Vehicle::create([
            'name' => 'Limo',
            'type' => 'limo',
            'passenger_capacity' => 8,
            'luggage_capacity' => 3,
            'description' => 'Luxury limousine for special occasions.',
            'base_rate' => 200.00,
            'is_available' => true,
            'image' => 'vehicles/limo.png',
        ]);

        Vehicle::create([
            'name' => 'Sprinter Van',
            'type' => 'sprinter_van',
            'passenger_capacity' => 12,
            'luggage_capacity' => 8,
            'description' => 'Versatile van for groups and luggage.',
            'base_rate' => 120.00,
            'is_available' => true,
            'image' => 'vehicles/van.png',
        ]);

        Vehicle::create([
            'name' => 'Mini Coach',
            'type' => 'mini_coach',
            'passenger_capacity' => 20,
            'luggage_capacity' => 10,
            'description' => 'Ideal for medium-sized group travel.',
            'base_rate' => 150.00,
            'is_available' => true,
            'image' => 'vehicles/coach.png',
        ]);

        Vehicle::create([
            'name' => 'Bus',
            'type' => 'bus',
            'passenger_capacity' => 40,
            'luggage_capacity' => 30,
            'description' => 'Perfect for large group transportation.',
            'base_rate' => 300.00,
            'is_available' => true,
            'image' => 'vehicles/bus.png',
        ]);
    }
}
