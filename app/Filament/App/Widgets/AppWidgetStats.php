<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Holiday;


class AppWidgetStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Vacaciones pendientes', $this->getPendingHoliday(Auth::user())),
            Stat::make('Vacaciones aprobadas', $this->getApprovedHoliday(Auth::user())),

        ];
    }
    protected function getPendingHoliday(User $user){
        $totalPendingHolidays = Holiday::where('user_id',$user->id)
            ->where('type','pendiente')->get()->count();
            return $totalPendingHolidays;
    }
    protected function getApprovedHoliday(User $user){
        $totalApprovedHolidays = Holiday::where('user_id',$user->id)
            ->where('type','aprobada')->get()->count();
            return $totalApprovedHolidays;
    }
}
