<?php

namespace App\Filament\Resources\BookingTravel\Pages;

use App\Filament\Resources\BookingTravel\BookingTravelResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBookingTravel extends EditRecord
{
    protected static string $resource = BookingTravelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
