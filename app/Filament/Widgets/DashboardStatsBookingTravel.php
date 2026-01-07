<?php

namespace App\Filament\Widgets;

use App\Models\BookingTravel;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DashboardStatsBookingTravel extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '15s';
    protected int | string | array $columnSpan = 'full';

    /**
     * 🔒 Atur siapa yang boleh melihat widget
     */
    public static function canView(): bool
    {
        $user = Auth::user();

        return in_array($user->role, [
            'super_admin',
            'admin_travel',
        ]);
    }

    protected function getStats(): array
    {
        $today = Carbon::today();

        $total = BookingTravel::count();

        $hariIni = BookingTravel::whereDate('tanggal_booking', $today)->count();

        $proses = BookingTravel::where('status', BookingTravel::STATUS_PROCESSS)->count();

        $jalan = BookingTravel::where('status', BookingTravel::STATUS_ON_THE_WAY)->count();

        $selesai = BookingTravel::where('status', BookingTravel::STATUS_COMPLETED)->count();

        $akanBerangkat = BookingTravel::whereDate('tanggal_booking', '>', $today)
            ->where('status', BookingTravel::STATUS_PROCESSS)
            ->count();

        return [
            Stat::make('Total Booking', $total)
                ->description('Seluruh booking travel')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info'),

            Stat::make('Booking Hari Ini', $hariIni)
                ->description('Keberangkatan hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),

            Stat::make('Proses', $proses)
                ->description('Menunggu berangkat')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Lagi di Jalan', $jalan)
                ->description('Sedang perjalanan')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info'),

            Stat::make('Selesai', $selesai)
                ->description('Trip selesai')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Akan Berangkat', $akanBerangkat)
                ->description('Booking mendatang')
                ->descriptionIcon('heroicon-m-arrow-right-circle')
                ->color('secondary'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
