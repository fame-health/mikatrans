<?php

namespace App\Filament\Resources\BookingTravel;

use App\Filament\Resources\BookingTravel\Pages\CreateBookingTravel;
use App\Filament\Resources\BookingTravel\Pages\EditBookingTravel;
use App\Filament\Resources\BookingTravel\Pages\ListBookingTravel;
use App\Filament\Resources\BookingTravel\Pages\ViewBookingTravel;
use App\Filament\Resources\BookingTravel\Schemas\BookingTravelForm;
use App\Filament\Resources\BookingTravel\Schemas\BookingTravelInfolist;
use App\Filament\Resources\BookingTravel\Tables\BookingTravelTable;
use App\Models\BookingTravel;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class BookingTravelResource extends Resource
{
    protected static ?string $model = BookingTravel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'yes';

    /**
     * Form schema
     */
    public static function form(Schema $schema): Schema
    {
        return BookingTravelForm::configure($schema);
    }

    /**
     * Info list schema
     */
    public static function infolist(Schema $schema): Schema
    {
        return BookingTravelInfolist::configure($schema);
    }

    /**
     * Table schema
     */
    public static function table(Table $table): Table
    {
        return BookingTravelTable::configure($table);
    }

    /**
     * Relations
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * Pages
     */
    public static function getPages(): array
    {
        return [
            'index' => ListBookingTravel::route('/'),
            'create' => CreateBookingTravel::route('/create'),
            'view' => ViewBookingTravel::route('/{record}'),
            'edit' => EditBookingTravel::route('/{record}/edit'),
        ];
    }

    /**
     * Batasi akses resource hanya untuk super_admin dan admin_travel
     */
    public static function canAccess(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user && ($user->isSuperAdmin() || $user->isAdminTravel());
    }
}
