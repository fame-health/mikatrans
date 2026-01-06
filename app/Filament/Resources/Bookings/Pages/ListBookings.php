<?php

namespace App\Filament\Resources\Bookings\Pages;

use App\Filament\Resources\Bookings\BookingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }

    /**
     * 🔥 Filter query berdasarkan role dan tipe kendaraan
     */
    protected function tableQuery(): Builder
    {
        $user = Auth::user();
        $query = BookingResource::getEloquentQuery(); // ini pasti Eloquent Builder

        if (!$user) {
            return $query->whereNull('id'); // kosong kalau tidak login
        }

        if ($user->role === 'super_admin') {
            return $query; // lihat semua
        }

        if ($user->role === 'admin_bus') {
            return $query->whereHas('vehicle', fn(Builder $q) => $q->where('type', 'bus'));
        }

        if ($user->role === 'admin_travel') {
            return $query->whereHas('vehicle', fn(Builder $q) => $q->where('type', 'travel'));
        }

        return $query->whereNull('id'); // default kosong
    }
}
