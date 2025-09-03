<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Collection;

use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
# use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;






class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


/* Formularios Crear y Editar sin secciones
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('password')
                    ->password()
                    ->required(), */

// Formularios crear y Editar con secciones
                Section::make('Datos personales')
                ->description('Información básica del usuario')
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    Select::make('departaments.name')
                        ->label('Departamento')
                        ->relationship(name: 'departaments', titleAttribute: 'name'),
                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required(),
                    DateTimePicker::make('email_verified_at'),
                    TextInput::make('password')
                        ->password()
                        ->hiddenOn('edit')
                        ->required(),

                    FileUpload::make('image')
                    ->image()
                    ->imageEditor(),


                ])
                ->columns(2)
                ->columnSpanFull(),

                Section::make('Información de dirección')
                ->description('Información de la dirección del usuario')
                ->schema([
                    Select::make('country_id')
                        ->relationship(name: 'country', titleAttribute: 'name')
                        ->searchable()
                        ->preload()
                        ->live()
                        # Limpiar estados y ciudades al cambiar país
                        ->afterStateUpdated(function(Set $set) {
                            $set('state_id', null);
                            $set('city_id', null);
                        })
                        ->required(),


                    Select::make('state_id')
                        ->options(fn (Get $get): Collection => State::query()
                        ->where('country_id', $get('country_id'))
                        ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->live()
                        # Limpiar estados y ciudades al cambiar país
                        ->afterStateUpdated(function(Set $set) {
                            $set('city_id', null);
                        })
                        ->required(),

                    Select::make('city_id')
                        ->options(fn (Get $get): Collection => City::where('state_id', $get('state_id'))->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required(),

                    TextInput::make('address')
                        ->required(),

                    TextInput::make('postal_code')
                        ->required(),

                ])
                ->columns(2)
                ->columnSpanFull(),


                ]);
    }
}
