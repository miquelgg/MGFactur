<?php

namespace App\Filament\Resources\Calendars;

use App\Filament\Resources\Calendars\Pages\CreateCalendar;
use App\Filament\Resources\Calendars\Pages\EditCalendar;
use App\Filament\Resources\Calendars\Pages\ListCalendars;
use App\Filament\Resources\Calendars\Schemas\CalendarForm;
use App\Filament\Resources\Calendars\Tables\CalendarsTable;
use App\Models\Calendar;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CalendarResource extends Resource
{
    protected static ?string $model = Calendar::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';


    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Calendarios';
    protected static ?string $navigationLabel = 'Calendarios';

    protected static string | UnitEnum | null $navigationGroup = 'Administración del sistema';
    protected static ?int $navigationSort = 12;

    public static function form(Schema $schema): Schema
    {
        return CalendarForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CalendarsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCalendars::route('/'),
            'create' => CreateCalendar::route('/create'),
            'edit' => EditCalendar::route('/{record}/edit'),
        ];
    }
}
