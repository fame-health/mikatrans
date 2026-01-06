<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class UpdateBookingStatus extends Command
{
    protected $signature = 'booking:update-status';
    protected $description = 'Auto update booking status berdasarkan tanggal';

    public function handle()
    {
        Booking::whereNotIn('status', ['cancelled'])
            ->chunk(100, function ($bookings) {
                foreach ($bookings as $booking) {
                    $booking->autoUpdateStatusByDate();
                }
            });

        $this->info('Booking status berhasil diperbarui.');
    }
}
