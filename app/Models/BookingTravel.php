<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookingTravel extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'booking_travels';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'tanggal_booking',
        'nama_penumpang',
        'nomor_hp',
        'no_kursi',
        'jadwal_berangkat',
        'alamat_penjemputan',
        'tujuan',
        'status',
    ];

    /**
     * Tipe data yang harus di-cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_booking' => 'date:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Status constants untuk memudahkan penggunaan.
     */
    public const STATUS_PROCESSS = 'PROSES';
    public const STATUS_ON_THE_WAY = 'LAGI_DI_JALAN';
    public const STATUS_COMPLETED = 'SELESAI';

    /**
     * Jadwal constants.
     */
    public const SCHEDULE_MORNING = 'PAGI';
    public const SCHEDULE_NIGHT = 'MALAM';

    /**
     * Mendapatkan array semua status yang tersedia.
     *
     * @return array
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PROCESSS,
            self::STATUS_ON_THE_WAY,
            self::STATUS_COMPLETED,
        ];
    }

    /**
     * Mendapatkan array semua jadwal yang tersedia.
     *
     * @return array
     */
    public static function getSchedules(): array
    {
        return [
            self::SCHEDULE_MORNING,
            self::SCHEDULE_NIGHT,
        ];
    }

    /**
     * Scope untuk memfilter berdasarkan status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk memfilter berdasarkan tanggal booking.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByBookingDate($query, string $date)
    {
        return $query->where('tanggal_booking', $date);
    }

    /**
     * Scope untuk memfilter berdasarkan rentang tanggal.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $startDate
     * @param string $endDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDateRange($query, string $startDate, string $endDate)
    {
        return $query->whereBetween('tanggal_booking', [$startDate, $endDate]);
    }

    /**
     * Scope untuk memfilter berdasarkan jadwal.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $schedule
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySchedule($query, string $schedule)
    {
        return $query->where('jadwal_berangkat', $schedule);
    }

    /**
     * Scope untuk memfilter berdasarkan pengguna.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Relasi ke model User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mengecek apakah booking dalam status "PROSES".
     *
     * @return bool
     */
    public function isProses(): bool
    {
        return $this->status === self::STATUS_PROCESSS;
    }

    /**
     * Mengecek apakah booking dalam status "LAGI_DI_JALAN".
     *
     * @return bool
     */
    public function isOnTheWay(): bool
    {
        return $this->status === self::STATUS_ON_THE_WAY;
    }

    /**
     * Mengecek apakah booking dalam status "SELESAI".
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Mengecek apakah jadwal adalah "PAGI".
     *
     * @return bool
     */
    public function isMorningSchedule(): bool
    {
        return $this->jadwal_berangkat === self::SCHEDULE_MORNING;
    }

    /**
     * Mengecek apakah jadwal adalah "MALAM".
     *
     * @return bool
     {
        return $this->jadwal_berangkat === self::SCHEDULE_NIGHT;
    }

    /**
     * Mengubah status booking menjadi "LAGI_DI_JALAN".
     *
     * @return bool
     */
    public function markAsOnTheWay(): bool
    {
        return $this->update(['status' => self::STATUS_ON_THE_WAY]);
    }

    /**
     * Mengubah status booking menjadi "SELESAI".
     *
     * @return bool
     */
    public function markAsCompleted(): bool
    {
        return $this->update(['status' => self::STATUS_COMPLETED]);
    }

    /**
     * Accessor untuk format tanggal booking yang lebih baik.
     * SOLUSI: Menggunakan helper Carbon::parse() untuk memastikan format yang benar
     *
     * @return string
     */
    public function getTanggalBookingFormattedAttribute(): string
    {
        // Menggunakan Carbon::parse() untuk memastikan format tanggal yang benar
        return Carbon::parse($this->tanggal_booking)->format('d/m/Y');
    }

    /**
     * Accessor untuk mendapatkan tanggal dalam format Indonesia.
     *
     * @return string
     */
    public function getTanggalBookingIndoAttribute(): string
    {
        $carbonDate = Carbon::parse($this->tanggal_booking);
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $carbonDate->format('d') . ' ' . $bulan[$carbonDate->format('n')] . ' ' . $carbonDate->format('Y');
    }

    /**
     * Accessor untuk status dalam format yang lebih mudah dibaca.
     *
     * @return string
     */
    public function getStatusTextAttribute(): string
    {
        $statusMap = [
            self::STATUS_PROCESSS => 'Proses',
            self::STATUS_ON_THE_WAY => 'Lagi di Jalan',
            self::STATUS_COMPLETED => 'Selesai',
        ];

        return $statusMap[$this->status] ?? $this->status;
    }

    /**
     * Accessor untuk jadwal berangkat dalam format yang lebih mudah dibaca.
     *
     * @return string
     */
    public function getJadwalBerangkatTextAttribute(): string
    {
        $scheduleMap = [
            self::SCHEDULE_MORNING => 'Pagi',
            self::SCHEDULE_NIGHT => 'Malam',
        ];

        return $scheduleMap[$this->jadwal_berangkat] ?? $this->jadwal_berangkat;
    }

    /**
     * Accessor untuk mendapatkan hari dari tanggal booking.
     *
     * @return string
     */
    public function getHariBookingAttribute(): string
    {
        $carbonDate = Carbon::parse($this->tanggal_booking);
        $hari = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        return $hari[$carbonDate->dayOfWeek];
    }

    /**
     * Accessor untuk mendapatkan tanggal booking dalam format input date.
     *
     * @return string
     */
    public function getTanggalBookingInputAttribute(): string
    {
        return Carbon::parse($this->tanggal_booking)->format('Y-m-d');
    }

    /**
     * Mutator untuk tanggal booking.
     * Memastikan format yang konsisten.
     *
     * @param mixed $value
     * @return void
     */
    public function setTanggalBookingAttribute($value): void
    {
        $this->attributes['tanggal_booking'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * Mendapatkan warna badge berdasarkan status.
     *
     * @return string
     */
    public function getStatusColorAttribute(): string
    {
        $colorMap = [
            self::STATUS_PROCESSS => 'warning',
            self::STATUS_ON_THE_WAY => 'info',
            self::STATUS_COMPLETED => 'success',
        ];

        return $colorMap[$this->status] ?? 'secondary';
    }

    /**
     * Mendapatkan icon berdasarkan status.
     *
     * @return string
     */
    public function getStatusIconAttribute(): string
    {
        $iconMap = [
            self::STATUS_PROCESSS => 'clock',
            self::STATUS_ON_THE_WAY => 'truck',
            self::STATUS_COMPLETED => 'check-circle',
        ];

        return $iconMap[$this->status] ?? 'info-circle';
    }
}
