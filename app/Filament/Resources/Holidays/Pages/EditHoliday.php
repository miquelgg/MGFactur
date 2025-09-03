<?php

namespace App\Filament\Resources\Holidays\Pages;

use App\Filament\Resources\Holidays\HolidayResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Filament\Notifications\Notification;


class EditHoliday extends EditRecord
{
    protected static string $resource = HolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
        {
            return $this->getResource()::getUrl('index');
        }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        $user = User::find($record->user_id);
        if($record->type == 'aprobada'){

            $recipient =$user;

            Notification::make()
                ->title('Solicitud de vacaciones')
                ->body("El día ".$data['day'].' esta aprobado')
                ->sendToDatabase($recipient);
        } else if($record->type == 'rechazada'){
            $recipient =$user;

            Notification::make()
                ->title('Solicitud de vacaciones')
                ->body("El día ".$data['day'].' esta rechazado')
                ->sendToDatabase($recipient);
        }
        return $record;
    }

}
