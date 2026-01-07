<?php

namespace App\Filament\Resources\BookingTravel\Tables;

use App\Models\BookingTravel;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class BookingTravelTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('tanggal_booking', 'desc') // urut terbaru paling atas
            ->columns([
                // Nomor urut

                TextColumn::make('nama_penumpang')
                    ->label('Nama Penumpang')
                    ->searchable()
                    ->sortable(),



                TextColumn::make('nomor_hp')
                    ->label('Nomor HP')
                    ->searchable(),

                TextColumn::make('no_kursi')
                    ->label('No. Kursi')
                    ->sortable(),

                TextColumn::make('tanggal_booking')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                // Jadwal lengkap dengan jam
                TextColumn::make('jadwal_berangkat_text')
                    ->label('Jadwal')
                    ->formatStateUsing(fn ($state, $record) => match ($record->jadwal_berangkat) {
                        BookingTravel::SCHEDULE_MORNING => 'Pagi - 10.00 WIB',
                        BookingTravel::SCHEDULE_NIGHT => 'Malam - 21.00 WIB',
                        default => $state,
                    }),
                TextColumn::make('alamat_penjemputan')
    ->label('Alamat Penjemputan')
    ->limit(50) // opsional, agar panjang teks tidak pecah tabel
    ->sortable()
    ->wrap(), // supaya teks panjang dibungkus


                TextColumn::make('tujuan')
                    ->label('Tujuan')
                    ->searchable(),

                // Status dengan warna + klik untuk ubah
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => BookingTravel::STATUS_PROCESSS,
                        'info' => BookingTravel::STATUS_ON_THE_WAY,
                        'success' => BookingTravel::STATUS_COMPLETED,
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        BookingTravel::STATUS_PROCESSS => 'Proses',
                        BookingTravel::STATUS_ON_THE_WAY => 'Lagi di Jalan',
                        BookingTravel::STATUS_COMPLETED => 'Selesai',
                        default => $state,
                    })
                    ->extraAttributes(['class' => 'cursor-pointer'])
                    ->action(function (BookingTravel $record) {
                        $nextStatus = match ($record->status) {
                            BookingTravel::STATUS_PROCESSS => BookingTravel::STATUS_ON_THE_WAY,
                            BookingTravel::STATUS_ON_THE_WAY => BookingTravel::STATUS_COMPLETED,
                            BookingTravel::STATUS_COMPLETED => BookingTravel::STATUS_PROCESSS,
                        };
                        $record->update(['status' => $nextStatus]);
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        BookingTravel::STATUS_PROCESSS => 'Proses',
                        BookingTravel::STATUS_ON_THE_WAY => 'Lagi di Jalan',
                        BookingTravel::STATUS_COMPLETED => 'Selesai',
                    ]),

                SelectFilter::make('jadwal_berangkat')
                    ->options([
                        BookingTravel::SCHEDULE_MORNING => 'Pagi',
                        BookingTravel::SCHEDULE_NIGHT => 'Malam',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
