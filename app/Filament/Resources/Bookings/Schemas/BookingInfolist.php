<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Booking;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /* ================= INFORMASI BOOKING ================= */
            Section::make('Informasi Booking')
                ->columns(4)
                ->schema([
                    TextEntry::make('booking_code')
                        ->label('Kode Booking')
                        ->weight('bold')
                        ->color('primary')
                        ->columnSpan(2),

                    TextEntry::make('status')
                        ->label('Status')
                        ->badge()
                        ->color(fn ($state) => match ($state) {
                            'pending' => 'warning',
                            'confirmed' => 'success',
                            'cancelled' => 'danger',
                            default => 'gray',
                        }),

                    TextEntry::make('payment_status')
                        ->label('Status Pembayaran')
                        ->badge()
                        ->formatStateUsing(fn ($state) => match ($state) {
                            'fully_paid' => 'Lunas',
                            'dp_paid' => 'DP Dibayar',
                            'unpaid' => 'Belum Dibayar',
                            default => ucfirst(str_replace('_', ' ', $state)),
                        })
                        ->color(fn ($state) => match ($state) {
                            'fully_paid' => 'success',
                            'dp_paid' => 'info',
                            'unpaid' => 'danger',
                            default => 'gray',
                        }),

                    TextEntry::make('vehicle_id')
                        ->label('Kendaraan')
                        ->numeric(),
                ]),

            /* ================= DATA CUSTOMER ================= */
            Section::make('Data Customer')
                ->columns(4)
                ->schema([
                    TextEntry::make('customer_name')
                        ->label('Nama Customer')
                        ->weight('bold')
                        ->columnSpan(2),

                    TextEntry::make('customer_phone')
                        ->label('No. HP'),

                    TextEntry::make('customer_email')
                        ->label('Email')
                        ->placeholder('-'),

                    TextEntry::make('customer_address')
                        ->label('Alamat')
                        ->columnSpanFull()
                        ->color('gray')
                        ->placeholder('-'),
                ]),

            /* ================= WAKTU & LOKASI ================= */
            Section::make('Waktu & Lokasi')
                ->columns(4)
                ->schema([
                    TextEntry::make('start_date')
                        ->label('Tanggal Mulai')
                        ->date(),

                    TextEntry::make('end_date')
                        ->label('Tanggal Selesai')
                        ->date(),

                    TextEntry::make('duration_days')
                        ->label('Durasi')
                        ->numeric()
                        ->suffix(' hari'),

                    TextEntry::make('pickup_location')
                        ->label('Lokasi Jemput')
                        ->columnSpan(2),

                    TextEntry::make('dropoff_location')
                        ->label('Lokasi Antar')
                        ->columnSpan(2),
                ]),

            /* ================= PEMBAYARAN ================= */
            Section::make('Pembayaran')
                ->columns(4)
                ->schema([
                    TextEntry::make('price_per_day')
                        ->label('Harga / Hari')
                        ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, '.', ','))
                        ->color('gray'),

                    TextEntry::make('total_price')
                        ->label('Total Harga')
                        ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, '.', ','))
                        ->weight('bold')
                        ->color('success'),

                    TextEntry::make('dp_amount')
                        ->label('DP')
                        ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, '.', ','))
                        ->color('info'),

                    TextEntry::make('remaining_amount')
                        ->label('Sisa Pembayaran')
                        ->weight('bold')
                        ->color('danger')
                        ->formatStateUsing(function (Booking $record) {
                            $total = $record->total_price ?? 0;
                            $dp = $record->dp_amount ?? 0;
                            $status = $record->payment_status;

                            $remaining = match ($status) {
                                'fully_paid' => 0,
                                'dp_paid' => max($total - $dp, 0),
                                'unpaid' => $total,
                                default => max($total - $dp, 0),
                            };

                            return 'Rp ' . number_format($remaining, 0, '.', ',');
                        }),
                ]),

            /* ================= INFORMASI TAMBAHAN ================= */
            Section::make('Informasi Tambahan')
                ->columns(4)
                ->schema([
                    TextEntry::make('special_request')
                        ->label('Permintaan Khusus')
                        ->columnSpanFull()
                        ->placeholder('-'),

                    TextEntry::make('cancellation_reason')
                        ->label('Alasan Pembatalan')
                        ->columnSpanFull()
                        ->placeholder('-'),

                    TextEntry::make('deleted_at')
                        ->label('Dihapus Pada')
                        ->dateTime()
                        ->color('danger')
                        ->visible(fn (Booking $record) => $record->trashed()),
                ]),
        ]);
    }
}
