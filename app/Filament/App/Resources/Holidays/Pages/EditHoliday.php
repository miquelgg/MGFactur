<?php

namespace App\Filament\App\Resources\Holidays\Pages;

use App\Filament\App\Resources\Holidays\HolidayResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHoliday extends EditRecord
{
    protected static string $resource = HolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
