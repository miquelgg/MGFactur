<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

# Para el filter
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;

# Para borrar registros individualmente
use Filament\Actions\DeleteAction;

# Para imágenes
use Filament\Tables\Columns\ImageColumn;

# Para la accion personalizada de Verified
use Filament\Actions\Action;
use App\Models\User;


class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Dirección')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('postal_code')
                    ->label('Código postal')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('departaments.name')
                    ->label('Departamento')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                ImageColumn::make('image')
                    ->visibility('private'),

                TextColumn::make('country.name')
                    ->label('Pais')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('state.name')
                    ->label('Estado')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('city.name')
                    ->label('Ciudad')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                TernaryFilter::make('email_verified_at')
                    ->label('Email verificat')
                    ->placeholder('Tots')
                    ->trueLabel('Només verificats')
                    ->falseLabel('Només no verificats')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('email_verified_at'),
                        false: fn ($query) => $query->whereNull('email_verified_at'),
                    ),

                  
                /*                 
                Filter::make('verified')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Filter::make('Not_verified')
                    ->query(fn (Builder $query): Builder => $query->whereNull('email_verified_at')), 
                */


           ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),   // Añadimos la opción de delete a las filas de la tabla
                Action::make('Verify')
                ->icon('heroicon-o-check')
                #->action(fn (User $record): void => $record->update(['email_verified_at' => now()])),
                ->action(function (User $user){
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->save();
                }),

                Action::make('Unverify')
                ->icon('heroicon-m-x-circle')
                #->action(fn (User $record): void => $record->update(['email_verified_at' => now()])),
                ->action(function (User $user){
                    $user->email_verified_at = null;
                    $user->save();
                }),



           ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
