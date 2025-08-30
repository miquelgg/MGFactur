<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Collection;
use App\Models\Country;
use App\Models\State;
use App\Models\City;


class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

/* Formulario Ver sin secciones
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('email_verified_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
 */

// Formulario Ver con secciones
                Section::make('Datos personales')
                ->description('Información básica del usuario')
                ->schema([
                    TextEntry::make('name'),
                    TextEntry::make('email')
                        ->label('Email address'),
                    TextEntry::make('email_verified_at')
                        ->dateTime(),
                    TextEntry::make('created_at')
                        ->dateTime(),
                    TextEntry::make('updated_at')
                        ->dateTime(),
                ])
                ->columns(2),


               Section::make('Información de dirección')
                ->description('Información de la dirección del usuario')
                ->schema([
                    TextEntry::make('country.name')
                    ->label('Pais'),
                    TextEntry::make('state.name')
                    ->label('Estado'),
                    TextEntry::make('city.name')
                    ->label('Ciudad'),
                    TextEntry::make('address')
                    ->label('Dirección'),

/*                     Select::make('state_id')
                        ->options(fn (Get $get): Collection => State::query()
                        ->where('country_id', $get('country_id'))
                        ->pluck('name', 'id'))
                        ->required(),

                    Select::make('city_id')
                        ->options(fn (Get $get): Collection => City::where('state_id', $get('state_id'))->pluck('name', 'id'))
                        ->required(),
 */
                ])
                ->columns(2),

            ]);
    }
}
