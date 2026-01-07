<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DashboardStats extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '15s';
    protected int | string | array $columnSpan = 'full';
        public static function canView(): bool
    {
        $user = Auth::user();

        return in_array($user->role, [
            'super_admin',
            'admin_bus',
        ]);
    }

    protected function getStats(): array
    {
        /** @var User $user */
        $user = Auth::user();
        $isSuperAdmin = $user->role === 'super_admin';

        /* ================= QUERY DASAR ================= */
        $vehicleQuery = $isSuperAdmin
            ? Vehicle::query()
            : Vehicle::where('owner_id', $user->id);

        $bookingQuery = $isSuperAdmin
            ? Booking::query()
            : Booking::whereHas('vehicle', fn ($q) => $q->where('owner_id', $user->id));

        /* ================= DATA STATISTIK ================= */
        $totalVehicles = $vehicleQuery->count();
        $totalBookings = $bookingQuery->count();
        $pendingBookings = (clone $bookingQuery)->where('status', 'pending')->count();
        $ongoingBookingsQuery = (clone $bookingQuery)->where('status', 'ongoing');
        $ongoingBookingsCount = $ongoingBookingsQuery->count();
        $completedBookings = (clone $bookingQuery)->where('status', 'completed')->count();

        /* ================= UNIT BERJALAN ================= */
        $ongoingVehicles = $ongoingBookingsQuery
            ->with('vehicle')
            ->get()
            ->map(fn($b) => $b->vehicle?->name ?? 'Tidak Diketahui')
            ->unique()
            ->values()
            ->take(3)
            ->toArray();

        $ongoingVehiclesText = count($ongoingVehicles) > 0
            ? implode(', ', $ongoingVehicles) . (count($ongoingVehicles) >= 3 ? '...' : '')
            : 'Tidak ada unit berjalan';

        /* ================= KEUANGAN ================= */
        $dpIncome = (clone $bookingQuery)
            ->where('payment_status', 'dp_paid')
            ->sum('dp_amount');

        $fullIncome = (clone $bookingQuery)
            ->where('payment_status', 'fully_paid')
            ->sum('total_price');

        $totalIncome = $dpIncome + $fullIncome;

        $remainingPayment = (clone $bookingQuery)
            ->where('status', '!=', 'cancelled')
            ->where('payment_status', 'dp_paid')
            ->selectRaw('SUM(total_price - dp_amount) as total')
            ->value('total') ?? 0;

        /* ================= PERSENTASE & TREND ================= */
        $completionRate = $totalBookings > 0
            ? round(($completedBookings / $totalBookings) * 100, 1)
            : 0;

        /* ================= CARD DESIGN WITH VIBRANT COLORS ================= */
        return [
            // Card 1: Total Armada - Vibrant Blue with Icon Background
            Stat::make(
                $isSuperAdmin ? 'Total Armada' : 'Kendaraan Saya',
                $totalVehicles
            )
                ->description('Unit siap operasional')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info')
                ->chart([12, 8, 15, 10, 18, 14, 20])
                ->extraAttributes([
                    'class' => 'relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 dark:from-blue-600 dark:via-blue-700 dark:to-blue-800 border-0 shadow-xl shadow-blue-500/50 dark:shadow-blue-900/50',
                    'style' => 'border-radius: 1rem; backdrop-filter: blur(10px);',
                ]),

            // Card 2: Booking Berjalan - Electric Purple
            Stat::make('Sedang Berjalan', $ongoingBookingsCount . ' Trip')
                ->description($ongoingVehiclesText)
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('purple')
                ->chart([5, 8, 12, 15, 18, 14, 20])
                ->extraAttributes([
                    'class' => 'relative overflow-hidden bg-gradient-to-br from-purple-500 via-purple-600 to-pink-600 dark:from-purple-600 dark:via-purple-700 dark:to-pink-700 border-0 shadow-xl shadow-purple-500/50 dark:shadow-purple-900/50 cursor-pointer hover:scale-105 transition-transform duration-300',
                    'style' => 'border-radius: 1rem; backdrop-filter: blur(10px);',
                ]),

            // Card 3: Pendapatan - Rich Green with Gold Accent
            Stat::make(
                $isSuperAdmin ? 'Total Omzet' : 'Pendapatan',
                'Rp ' . number_format($totalIncome, 0, ',', '.')
            )
                ->description('Uang masuk (DP + Lunas)')
                ->descriptionIcon('heroicon-m-banknotes')
                ->chart([10, 15, 20, 25, 30, 28, 35])
                ->color('success')
                ->extraAttributes([
                    'class' => 'relative overflow-hidden bg-gradient-to-br from-emerald-500 via-green-600 to-teal-600 dark:from-emerald-600 dark:via-green-700 dark:to-teal-700 border-0 shadow-xl shadow-green-500/50 dark:shadow-green-900/50',
                    'style' => 'border-radius: 1rem; backdrop-filter: blur(10px);',
                ]),

            // Card 4: Total Reservasi - Sunset Orange
            Stat::make('Total Reservasi', $totalBookings)
                ->description('Riwayat booking keseluruhan')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning')
                ->chart([15, 18, 12, 20, 16, 22, 25])
                ->extraAttributes([
                    'class' => 'relative overflow-hidden bg-gradient-to-br from-orange-500 via-amber-600 to-yellow-600 dark:from-orange-600 dark:via-amber-700 dark:to-yellow-700 border-0 shadow-xl shadow-orange-500/50 dark:shadow-orange-900/50',
                    'style' => 'border-radius: 1rem; backdrop-filter: blur(10px);',
                ]),

            // Card 5: Piutang - Bold Red
            Stat::make(
                $isSuperAdmin ? 'Total Piutang' : 'Sisa Tagihan',
                'Rp ' . number_format($remainingPayment, 0, ',', '.')
            )
                ->description('Pembayaran belum lunas')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger')
                ->chart([8, 12, 10, 15, 12, 18, 20])
                ->extraAttributes([
                    'class' => 'relative overflow-hidden bg-gradient-to-br from-red-500 via-rose-600 to-pink-600 dark:from-red-600 dark:via-rose-700 dark:to-pink-700 border-0 shadow-xl shadow-red-500/50 dark:shadow-red-900/50',
                    'style' => 'border-radius: 1rem; backdrop-filter: blur(10px);',
                ]),

            // Card 6: Selesai - Fresh Cyan
            Stat::make('Booking Selesai', $completedBookings)
                ->description($completionRate . '% dari total booking')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success')
                ->chart([5, 10, 15, 20, 22, 25, 30])
                ->extraAttributes([
                    'class' => 'relative overflow-hidden bg-gradient-to-br from-cyan-500 via-teal-600 to-emerald-600 dark:from-cyan-600 dark:via-teal-700 dark:to-emerald-700 border-0 shadow-xl shadow-cyan-500/50 dark:shadow-cyan-900/50',
                    'style' => 'border-radius: 1rem; backdrop-filter: blur(10px);',
                ]),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
