<?php

namespace App\Filament\Resources\Bookings\Schemas;

use App\Models\Vehicle;
use Filament\Forms;
use Filament\Schemas\Schema;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                /*
                |----------------------------------------------------------------------
                | BOOKING
                |----------------------------------------------------------------------
                */
                Forms\Components\TextInput::make('booking_code')
                    ->label('Kode Booking')
                    ->disabled()
                    ->dehydrated(false)
                    ->visibleOn('edit'),

                Forms\Components\Select::make('vehicle_id')
                    ->label('Kendaraan')
                    ->relationship(
                        'vehicle',
                        'name',
                        fn ($query) => $query->available()
                            ->when(
                                Auth::user()->role !== 'super_admin',
                                fn ($q) => $q->where('owner_id', Auth::id()) // Hanya kendaraan milik user login
                            )
                    )
                    ->getOptionLabelFromRecordUsing(fn (Vehicle $record) =>
                        "{$record->name} | {$record->license_plate} | Rp " .
                        number_format($record->price_per_day, 0, '.', ',')
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($vehicle = Vehicle::find($state)) {
                            $set('price_per_day', $vehicle->price_per_day);
                        }
                    }),

                /*
                |----------------------------------------------------------------------
                | CUSTOMER
                |----------------------------------------------------------------------
                */
                Forms\Components\TextInput::make('customer_name')
                    ->label('Nama Customer')
                    ->required(),

                Forms\Components\TextInput::make('customer_phone')
                    ->label('No. HP')
                    ->tel()
                    ->required(),

                Forms\Components\TextInput::make('customer_email')
                    ->label('Email')
                    ->email(),

                Forms\Components\Textarea::make('customer_address')
                    ->label('Alamat')
                    ->columnSpanFull(),

                /*
                |----------------------------------------------------------------------
                | TANGGAL
                |----------------------------------------------------------------------
                */
                Forms\Components\DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required()
                    ->reactive(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $start = $get('start_date');
                        $end   = $get('end_date');
                        $price = $get('price_per_day');

                        if ($start && $end && $price) {
                            $days = Carbon::parse($start)
                                ->diffInDays(Carbon::parse($end)) + 1;

                            $total = $days * $price;

                            $set('duration_days', $days);
                            $set('total_price', $total);
                            $set('remaining_amount', $total);
                        }
                    }),

                Forms\Components\TextInput::make('duration_days')
                    ->label('Durasi (Hari)')
                    ->numeric()
                    ->required(),

                /*
                |----------------------------------------------------------------------
                | LOKASI
                |----------------------------------------------------------------------
                */
                Forms\Components\TextInput::make('pickup_location')
                    ->label('Lokasi Jemput')
                    ->required(),

                Forms\Components\TextInput::make('dropoff_location')
                    ->label('Lokasi Antar'),

                Forms\Components\Textarea::make('special_request')
                    ->label('Permintaan Khusus')
                    ->columnSpanFull(),

                /*
                |----------------------------------------------------------------------
                | HARGA
                |----------------------------------------------------------------------
                */
                Forms\Components\TextInput::make('price_per_day')
                    ->label('Harga / Hari')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\TextInput::make('total_price')
                    ->label('Total Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                /*
                |----------------------------------------------------------------------
                | PEMBAYARAN
                |----------------------------------------------------------------------
                */
                Forms\Components\Select::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'unpaid'      => 'Belum Bayar',
                        'dp_paid'     => 'DP Dibayar',
                        'fully_paid'  => 'Lunas',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $total = (int) $get('total_price');

                        if ($get('payment_status') === 'fully_paid') {
                            $set('dp_amount', $total);
                            $set('remaining_amount', 0);
                        }

                        if ($get('payment_status') === 'unpaid') {
                            $set('dp_amount', 0);
                            $set('remaining_amount', $total);
                        }
                    }),

                Forms\Components\TextInput::make('dp_amount')
                    ->label('Jumlah DP')
                    ->numeric()
                    ->prefix('Rp')
                    ->visible(fn (callable $get) => $get('payment_status') === 'dp_paid')
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $total = (int) $get('total_price');
                        $dp    = (int) ($get('dp_amount') ?? 0);

                        $set('remaining_amount', max($total - $dp, 0));
                    }),

                Forms\Components\TextInput::make('remaining_amount')
                    ->label('Sisa Pembayaran')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated(),

                /*
                |----------------------------------------------------------------------
                | STATUS BOOKING
                |----------------------------------------------------------------------
                */
                Forms\Components\Select::make('status')
                    ->label('Status Booking')
                    ->required()
                    ->options([
                        'pending'   => 'Pending',
                        'confirmed' => 'Dikonfirmasi',
                        'ongoing'   => 'Sedang Berjalan',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->reactive()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        // Jika dibatalkan, sisa pembayaran otomatis jadi 0
                        if ($get('status') === 'cancelled') {
                            $set('remaining_amount', 0);
                        }
                    }),
            ]);
    }
}
