<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Vehicle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('user_id')
                //     ->numeric()
                //     ->minValue(0)
                //     ->nullable(),
                Hidden::make('user_id')
                    // ->label('User ID')
                    ->default(null),
                    // ->readOnly()
                    // ->nullable()
                    // ->disabled(),
                TextInput::make('pickup_location')
                    ->required(),
                TextInput::make('dropoff_location')
                    ->required(),
                DateTimePicker::make('pickup_datetime')
                    ->required(),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->required()
                    ->tel()
                    ->minLength(10)
                    ->maxLength(15)
                    ->rule('regex:/^\+?[0-9]{10,15}$/')
                    ->placeholder('123-456-7890'),
                TextInput::make('passengers')
                    ->required()
                    ->minValue(0)
                    ->numeric()
                    ->default(0),
                // Select::make('trip_type')
                //     ->label('Trip Type')
                //     ->options([
                //         1 => 'Point to Point',
                //         0 => 'Hourly',
                //     ])
                //     ->required()
                //     ->native(false),

                Radio::make('trip_type')
                    ->label('Trip Type')
                    ->options([
                        1 => 'Point to Point',
                        0 => 'Hourly',
                    ])
                    ->inline() // Optional: shows options side-by-side
                    ->required(),

                // Toggle::make('trip_type')
                //     ->required(),
                TextInput::make('luggage')
                    ->required()
                    ->minValue(0)
                    ->numeric()
                    ->default(0),
                // TextInput::make('vehicle_id')
                //     ->numeric()
                //     ->default(null),
                Select::make('vehicle_id')
                    ->label('Vehicle')
                    ->options(Vehicle::pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->default(null),
                TextInput::make('estimated_hours')
                    ->numeric()
                    ->minValue(0)
                    ->default(null),
                TextInput::make('iatan_account')
                    ->default(null),
                TextInput::make('ta_fee')
                    ->numeric()
                    ->minValue(0)
                    ->default(null),
                Toggle::make('with_pet')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                // TextInput::make('status')
                //     ->required()
                //     ->default('pending'),
                Select::make('status')
                ->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled', 'completed' => 'Completed'])
                ->required(),
                TextInput::make('guest_email')
                    ->email()
                    ->default(null),
            ]);
    }
}
