<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context) => $context === 'create'),

                Forms\Components\Select::make('role')
                    ->required()
                    ->options([
                        'super_admin' => 'Super Admin',
                        'admin_bus' => 'Admin Bus',
                        'admin_travel' => 'Admin Travel',
                    ]),

                Forms\Components\TextInput::make('phone')
                    ->label('No. HP')
                    ->tel(),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),

                Forms\Components\CheckboxList::make('permissions')
                    ->label('Permissions')
                    ->options([
                        'manage_users' => 'Kelola User',
                        'manage_vehicles' => 'Kelola Kendaraan',
                        'manage_bookings' => 'Kelola Booking',
                        'manage_payments' => 'Kelola Pembayaran',
                    ])
                    ->columns(2),
            ])
            ->columns(2);
    }
}
