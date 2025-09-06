<?php

namespace App\Filament\Resources\Holidays\Pages;

use App\Filament\Resources\Holidays\HolidayResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;
use EightyNine\ExcelImport\ExcelImportAction\description;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
#use App\Http\Controllers\PdfController;

class ListHolidays extends ListRecords
{
    protected static string $resource = HolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExcelImportAction::make()
                ->color('success')
                ->label('Importar desde Excel')
                ->modalHeading('Importar desde archivo Excel')
                ->modalSubheading('Selecciona un archivo Excel para importar los datos.')
                // ->use(App\Imports\MyClientImport::class),  # Tu clase de importación personalizada
                // ->icon('heroicon-o-document-upload')
                // ->disablePreview()
                // ->disableFileNameInput()
                // ->disableFileSizeInput()
                // ->disk('public')
                // ->directory('imports')
                // ->maxFileSize(5120) //5MB
                // ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
                // ->action(route('filament.resources.holidays.import'))
                ->extraModalFooterActions([
                        Action::make('download-template')
                            ->label('Descargar plantilla')
                            ->color('secondary')
                            ->icon('heroicon-o-arrow-down-tray')
                            ->action(function () {
                                // Si ya tienes un Excel de plantilla en storage/app/public/templates/holiday.xlsx
                                return response()->download(
                                    Storage::disk('public')->path('templates/holiday.xlsx'),
                                    'PlantillaImportacion.xlsx'
                                );
                            }),
                        ]),
            Action::make('createPDF')
                ->label('Exportar PDF')
                ->color('secondary')
                ->requiresConfirmation()
                // ->icon('heroicon-o-document-download')
                // ->action(function(){
                //     $pdf = Pdf::loadView('pdf.example');
                //     return $pdf->download('example.pdf');
                // })
                ->url(
                    fn(): string => route('pdf.example', ['user' => Auth::user()]),
                    shouldOpenInNewTab: true
                ),
        ];
    }
}
