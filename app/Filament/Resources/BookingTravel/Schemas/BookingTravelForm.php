<?php

namespace App\Filament\Resources\BookingTravel\Schemas;

use App\Models\BookingTravel;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class BookingTravelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(fn () => Filament::auth()->user()->id),

                DatePicker::make('tanggal_booking')
                    ->label('Tanggal Booking')
                    ->required()
                    ->reactive(),

                Select::make('jadwal_berangkat')
                    ->label('Jadwal Berangkat')
                    ->options([
                        BookingTravel::SCHEDULE_MORNING => 'Pagi - 10.00 WIB',
                        BookingTravel::SCHEDULE_NIGHT => 'Malam - 21.00 WIB',
                    ])
                    ->required()
                    ->reactive(),

                Select::make('no_kursi')
                    ->label('No Kursi')
                    ->options(function (callable $get) {
                        $tanggal = $get('tanggal_booking');
                        $jadwal  = $get('jadwal_berangkat');

                        if (! $tanggal || ! $jadwal) {
                            return [];
                        }

                        $kursiTerpakai = BookingTravel::where('tanggal_booking', $tanggal)
                            ->where('jadwal_berangkat', $jadwal)
                            ->pluck('no_kursi')
                            ->toArray();

                        $semuaKursi = range(1, 10);

                        $kursiKosong = array_diff($semuaKursi, $kursiTerpakai);

                        return collect($kursiKosong)
                            ->mapWithKeys(fn ($k) => [$k => "Kursi $k"])
                            ->toArray();
                    })
                    ->required()
                    ->disabled(fn (callable $get) =>
                        ! $get('tanggal_booking') || ! $get('jadwal_berangkat')
                    )
                    ->helperText('Pilih tanggal & jadwal terlebih dahulu'),

                TextInput::make('nama_penumpang')
                    ->label('Nama Penumpang')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nomor_hp')
                    ->label('Nomor HP')
                    ->tel()
                    ->required(),

                Textarea::make('alamat_penjemputan')
                    ->label('Alamat Penjemputan')
                    ->rows(3)
                    ->required(),

                Select::make('tujuan')
                    ->label('Tujuan')
                    ->options([
                        'Tembilahan' => 'Tembilahan',
                        'Pekanbaru' => 'Pekanbaru',
                    ])
                    ->required(),

                Select::make('status')
                    ->options([
                        BookingTravel::STATUS_PROCESSS => 'Proses',
                        BookingTravel::STATUS_ON_THE_WAY => 'Lagi di Jalan',
                        BookingTravel::STATUS_COMPLETED => 'Selesai',
                    ])
                    ->default(BookingTravel::STATUS_PROCESSS)
                    ->required(),
            ]);
    }
}
