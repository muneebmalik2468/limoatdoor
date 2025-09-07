<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pickup_location')
                    ->searchable(),
                TextColumn::make('dropoff_location')
                    ->searchable(),
                TextColumn::make('pickup_datetime')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->formatStateUsing(fn ($state) => '$' . number_format($state, 2))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('distance_in_miles')
                    ->label('Distance')
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . ' miles')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('duration_in_minutes')
                    ->label('Duration')
                    ->formatStateUsing(fn ($state) => $state . ' mins')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('guest_email')
                    ->searchable(),
                // TextColumn::make('status')
                //     ->searchable(),
                TextColumn::make('status')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'confirmed' => 'success',
                    'cancelled' => 'danger',
                    'completed' => 'gray',
                }),
                TextColumn::make('trip_type')
                    ->label('Trip Type')
                    ->formatStateUsing(fn ($state) => $state ? 'point to point' : 'hourly'),
                // IconColumn::make('trip_type')
                //     ->boolean(),
                TextColumn::make('passengers')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('luggage')
                    ->numeric()
                    ->sortable(),
                // TextColumn::make('vehicle_id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('vehicle.name')
                    ->label('Vehicle')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('with_pet')
                    ->boolean(),
                TextColumn::make('estimated_hours')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('iatan_account')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ta_fee')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
