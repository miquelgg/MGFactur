<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use App\Filament\Resources\Users\RelationManagers\HolidaysRelationManager;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    ##protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|BackedEnum|null $navigationIcon = "heroicon-o-users";
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Usuario';
    protected static ?string $navigationLabel = 'Mis Usuarios';
    protected static string | UnitEnum | null $navigationGroup = 'Administración de usuarios';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);

    }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            HolidaysRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

}
