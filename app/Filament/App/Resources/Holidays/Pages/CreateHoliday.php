<?php

namespace App\Filament\App\Resources\Holidays\Pages;

use App\Filament\App\Resources\Holidays\HolidayResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateHoliday extends CreateRecord
{
    protected static string $resource = HolidayResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        # Creamos los campos que faltan en el registro
        $data['user_id'] = auth()->id();
        $data['type'] = 'pendiente';

        # Notificación simple
        Notification::make()
            ->title('Festivo solictado correctamente')
            ->body('El dia '. $data['day']. ' está pendiene de aprobar.')
            ->success()
            ->send();

        # Notificación de tipo BBDD (tienen que estar las colas activas)
        $recipient = auth()->user();
        Notification::make()
            ->title('Festivo solictado correctamente')
            ->body('El dia '. $data['day']. ' está pendiene de aprobar.')
            ->success()
            ->sendToDatabase($recipient);

        return $data;
    }


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }    
}
