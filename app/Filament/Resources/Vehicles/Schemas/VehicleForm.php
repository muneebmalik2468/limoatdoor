<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('type')
                    ->options(['sedan' => 'Sedan', 'suv' => 'SUV', 'sprinter_van' => 'Van', 'mini_coach' => 'Mini Coach', 'limo' => 'Limo', 'bus' => 'Bus'])
                    ->required(),
                TextInput::make('passenger_capacity')
                    ->required()
                    ->minValue(0)
                    ->numeric(),
                TextInput::make('luggage_capacity')
                    ->required()
                    ->minValue(0)
                    ->numeric(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('base_rate')
                    ->label('Base Rate')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->required(),

                TextInput::make('hourly_rate')
                    ->label('Hourly Rate')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->required(),

                // TextInput::make('base_rate')
                //     ->numeric()
                //     ->minValue(0)
                //     ->required(),
                //     ->default(null),
                Toggle::make('is_available')
                    ->required(),
                // FileUpload::make('image')
                //     ->image(),
            ]);
    }
}
