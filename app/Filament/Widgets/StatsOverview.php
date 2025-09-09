<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Today\'s Revenue', '$' . Booking::whereDate('created_at', Carbon::today())->sum('price'))
            //     ->description('Revenue from today\'s bookings')
            //     ->color('success'),
            Stat::make('Today\'s Bookings', Booking::whereDate('created_at', Carbon::today())->count())
                ->description('Bookings made today')
                ->color('success'),
            Stat::make('Total Bookings', Booking::count())
                ->description('Total bookings made')
                ->color('primary'),

            Stat::make('Vehicles', Vehicle::count())
                ->description('Total vehicles available')
                ->color('primary'),

            Stat::make('Users', User::count())
                ->description('Total registered users')
                ->color('info'),
            // Stat::make('Total Feedbacks', Feedback::count())
            //     ->description('Customer feedback submitted')
            //     ->color('primary'),
            Stat::make('Avg. Rating', number_format(Feedback::avg('rating'), 1) . ' / 5')
                ->description('Average customer rating')
                ->color('warning'),
        ];
    }
    // protected string $view = 'filament.widgets.stats-overview';
}
