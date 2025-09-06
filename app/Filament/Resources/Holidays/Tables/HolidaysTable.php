<?php

namespace App\Filament\Resources\Holidays\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;


class HolidaysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('calendar.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('day')
                    ->searchable()
                    ->date()
                    ->sortable(),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pendiente' => 'info',
                        'aprobada' => 'success',
                        'rechazada' => 'danger',
                    })
                    ->searchable(),
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
                SelectFilter::make('type')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'aprobada' => 'Aprobada',
                        'rechazada' => 'Rechazada',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),

                ExportBulkAction::make()
                    ->exports([
                            #ExcelExport::make()
                            ExcelExport::make('form')->fromForm(),
                            ExcelExport::make('table')->fromTable()
                                ->fromModel() // <- evita el mapeo a columnas montadas
                                ->withColumns([
                                    Column::make('calendar.name')->heading('Calendario'),
                                    Column::make('user.name')->heading('Usuario'),
                                    Column::make('day')
                                        ->heading('Día')
                                        ->formatStateUsing(
                                            fn ($record) => optional($record->day)->format('Y-m-d')
                                        ),
                                    Column::make('type')->heading('Tipo'),
                                ])
                                ->askForFilename('NombrePorDefecto') // <- permite al usuario definir el nombre del archivo
                                ->askForWriterType() // <- permite al usuario seleccionar el tipo de archivo
                                ->withFilename('holidays-export'),
                    ]),                
            ]);
    }
}
