<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Select::make('owner_id')
                    ->label('Pemilik')
                    ->relationship('owner', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('type')
                    ->label('Tipe Kendaraan')
                    ->required()
                    ->options([
                        'bus' => 'Bus',
                        'travel_car' => 'Mobil Travel',
                    ]),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Kendaraan')
                    ->required(),

                Forms\Components\TextInput::make('license_plate')
                    ->label('Plat Nomor')
                    ->required(),

                Forms\Components\TextInput::make('brand')
                    ->label('Merk')
                    ->required(),

                Forms\Components\TextInput::make('year')
                    ->numeric()
                    ->label('Tahun')
                    ->required(),

                Forms\Components\TextInput::make('seat_capacity')
                    ->numeric()
                    ->label('Kapasitas Kursi')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'available' => 'Tersedia',
                        'booked' => 'Dibooking',
                        'maintenance' => 'Perawatan',
                    ])
                    ->default('available'),

                Forms\Components\CheckboxList::make('facilities')
                    ->label('Fasilitas')
                    ->options([
                        'ac' => 'AC',
                        'wifi' => 'WiFi',
                        'toilet' => 'Toilet',
                        'charger' => 'Charger',
                        'tv' => 'TV',
                        'reclining_seat' => 'Kursi Reclining',
                    ])
                    ->columns(3),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('price_per_day')
                    ->numeric()
                    ->prefix('Rp')
                    ->label('Harga / Hari')
                    ->required(),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto Kendaraan')
                    ->image()
                    ->directory('vehicles')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
