<?php

namespace App\Filament\Resources\Vehicles\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;

class VehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            /* ================= QUERY ACCESS CONTROL ================= */
            ->modifyQueryUsing(function ($query) {
                $user = Auth::user();

                // SUPER ADMIN → semua data
                if ($user->role === 'super_admin') {
                    return;
                }

                // ADMIN BUS → hanya bus miliknya
                if ($user->role === 'admin_bus') {
                    $query->where('owner_id', $user->id)
                          ->where('type', 'bus');
                    return;
                }

                // ADMIN TRAVEL → hanya travel_car miliknya
                if ($user->role === 'admin_travel') {
                    $query->where('owner_id', $user->id)
                          ->where('type', 'travel_car');
                    return;
                }

                // USER biasa → tidak dapat lihat kendaraan (opsional)
                $query->whereRaw('1 = 0'); // menampilkan kosong
            })

            /* ================= COLUMNS ================= */
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Kendaraan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('license_plate')
                    ->label('Plat'),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'bus',
                        'warning' => 'travel_car',
                    ]),

                Tables\Columns\TextColumn::make('seat_capacity')
                    ->label('Kursi'),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'available',
                        'danger'  => 'booked',
                        'warning' => 'maintenance',
                    ]),

                Tables\Columns\TextColumn::make('price_per_day')
                    ->label('Harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('owner.name')
                    ->label('Pemilik'),
            ])

            /* ================= FILTERS ================= */
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('type')
                    ->label('Tipe Kendaraan')
                    ->options([
                        'bus'        => 'Bus',
                        'travel_car' => 'Travel Car',
                    ]),
            ])

            /* ================= RECORD ACTIONS ================= */
            ->recordActions([
                EditAction::make(),
            ])

            /* ================= TOOLBAR ACTIONS ================= */
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
