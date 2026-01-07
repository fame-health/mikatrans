<?php

namespace App\Filament\Resources\BookingTravel\Pages;

use App\Filament\Resources\BookingTravel\BookingTravelResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookingTravel extends ListRecords
{
    protected static string $resource = BookingTravelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
