<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Holiday;


class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::all()->count();
        $totalHolidays = Holiday::where('type','pendiente')->count();
        return [
            //
            Stat::make('Usuarios', $totalUsers)
                ->description('Total de usuarios')
                ->color('primary')
                ->icon('heroicon-o-users')
                ->descriptionIcon('heroicon-o-users'),
            Stat::make('Vacaciones Pendientes', $totalHolidays)
                ->description('Total de vacaciones pendientes')
                ->color('info')
                ->icon('heroicon-o-calendar-days')
                ->descriptionIcon('heroicon-o-calendar-days'),
            Stat::make('Prueba', '192.1K')
                ->description('Datos ficticios todavia')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
