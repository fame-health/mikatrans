<?php

namespace App\Filament\Resources\BookingTravel\Pages;

use App\Filament\Resources\BookingTravel\BookingTravelResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBookingTravel extends ViewRecord
{
    protected static string $resource = BookingTravelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
