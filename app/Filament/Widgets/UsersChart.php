<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;

class UsersChart extends ChartWidget
{
    protected ?string $heading = 'Users Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Usuarios (Dades ficties) p.e. vacaciones/mes',
                    'data' => [20, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                    'backgroundColor' => '#3b82f6', // blau
                ],
            ],
            'labels' => $this->getDataUser(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getDataUser() {
        return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    }
}
