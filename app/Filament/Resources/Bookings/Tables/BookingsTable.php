<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            /* ================= QUERY ACCESS CONTROL ================= */
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();

                // SUPER ADMIN → semua data
                if ($user->role === 'super_admin') {
                    $query->orderBy('created_at', 'desc'); // terbaru paling atas
                    return;
                }

                // ADMIN BUS / ADMIN TRAVEL → booking kendaraan miliknya
                if (in_array($user->role, ['admin_bus', 'admin_travel'])) {
                    $query->whereHas('vehicle', function ($q) use ($user) {
                        $q->where('owner_id', $user->id);
                    })->orderBy('created_at', 'desc'); // terbaru paling atas
                    return;
                }

                // USER BIASA → booking yang dibuat sendiri
                $query->where('created_by', $user->id)
                      ->orderBy('created_at', 'desc'); // terbaru paling atas
            })

            /* ================= COLUMNS ================= */
            ->columns([
                TextColumn::make('booking_code')
                    ->label('Kode Booking')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer_name')
                    ->label('Customer')
                    ->searchable(),

                TextColumn::make('vehicle.name')
                    ->label('Kendaraan')
                    ->sortable(),

                /* ================= STATUS ================= */
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'primary' => 'ongoing',
                        'gray'    => 'completed',
                        'danger'  => 'cancelled',
                    ])
                    ->action(
                        Action::make('updateStatus')
                            ->label('Ubah Status')
                            ->schema([
                                Select::make('status')
                                    ->label('Status Booking')
                                    ->options([
                                        'pending'   => 'Pending',
                                        'confirmed' => 'Confirmed',
                                        'ongoing'   => 'Ongoing',
                                        'completed' => 'Completed',
                                        'cancelled' => 'Cancelled',
                                    ])
                                    ->required(),
                            ])
                            ->mountUsing(fn ($form, $record) =>
                                $form->fill(['status' => $record->status])
                            )
                            ->action(fn ($record, array $data) =>
                                $record->update(['status' => $data['status']])
                            )
                            ->successNotificationTitle('Status berhasil diperbarui')
                    ),

                /* ================= PAYMENT ================= */
                TextColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->badge()
                    ->colors([
                        'danger'  => 'unpaid',
                        'warning' => 'dp_paid',
                        'success' => 'fully_paid',
                    ]),

                TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR'),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date(),

                TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date(),
            ])

            /* ================= FILTERS ================= */
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Booking')
                    ->options([
                        'pending'   => 'Pending',
                        'confirmed' => 'Confirmed',
                        'ongoing'   => 'Ongoing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                TrashedFilter::make(),
            ])

            /* ================= ACTIONS ================= */
            ->recordActions([
                // Tombol View yang lebih menarik
                ViewAction::make()
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->button(),

                EditAction::make()
                    ->label('Edit')
                    ->button(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
