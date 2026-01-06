<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_code',
        'vehicle_id',
        'schedule_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'start_date',
        'end_date',
        'duration_days',
        'pickup_location',
        'dropoff_location',
        'special_request',
        'price_per_day',
        'total_price',
        'dp_amount',
        'remaining_amount',
        'status',
        'payment_status',
        'cancellation_reason',
        'cancelled_at',
        'cancelled_by',
        'created_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'duration_days' => 'integer',
            'price_per_day' => 'decimal:2',
            'total_price' => 'decimal:2',
            'dp_amount' => 'decimal:2',
            'remaining_amount' => 'decimal:2',
            'cancelled_at' => 'datetime',
        ];
    }

    /**
     * Boot method to auto-generate booking code
     */
protected static function boot()
{
    parent::boot();

    // 🔹 Auto-generate booking code saat create
    static::creating(function ($booking) {
        if (empty($booking->booking_code)) {
            $booking->booking_code = 'BKG-' . strtoupper(\Illuminate\Support\Str::random(10));
        }
    });

    // 🔹 Auto-hapus remaining_amount saat status diubah menjadi cancelled
    static::updating(function ($booking) {
        if ($booking->isDirty('status') && $booking->status === 'cancelled') {
            $booking->remaining_amount = 0;
        }
    });

    // 🔹 Auto-update status berdasarkan tanggal (opsional)
    static::saving(function ($booking) {
        if ($booking->status !== 'cancelled') {
            $today = \Carbon\Carbon::today();

            if ($today->lt($booking->start_date)) {
                $booking->status = 'confirmed';
            } elseif ($today->between($booking->start_date, $booking->end_date)) {
                $booking->status = 'ongoing';
            } elseif ($today->gt($booking->end_date)) {
                $booking->status = 'completed';
            }
        }
    });
}


    /**
     * Get the vehicle for this booking
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    /**
     * Get the schedule for this booking
     */
    public function schedule()
    {
        return $this->belongsTo(VehicleSchedule::class, 'schedule_id');
    }

    /**
     * Get the user who created this booking
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who cancelled this booking
     */
    public function canceller()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    /**
     * Get payments for this booking
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id');
    }

    /**
     * Get documents for this booking
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'booking_id');
    }

    /**
     * Check if booking is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if booking is confirmed
     */
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if booking is ongoing
     */
    public function isOngoing(): bool
    {
        return $this->status === 'ongoing';
    }

    /**
     * Check if booking is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if booking is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if DP is paid
     */
    public function isDpPaid(): bool
    {
        return in_array($this->payment_status, ['dp_paid', 'fully_paid']);
    }

    /**
     * Check if fully paid
     */
    public function isFullyPaid(): bool
    {
        return $this->payment_status === 'fully_paid';
    }

    /**
     * Confirm booking
     */
    public function confirm(): bool
    {
        return $this->update(['status' => 'confirmed']);
    }

    /**
     * Cancel booking
     */
    public function cancel(string $reason, int $cancelledBy): bool
    {
        return $this->update([
            'status' => 'cancelled',
            'cancellation_reason' => $reason,
            'cancelled_at' => now(),
            'cancelled_by' => $cancelledBy,
        ]);
    }

    /**
     * Set booking as ongoing
     */
    public function setOngoing(): bool
    {
        return $this->update(['status' => 'ongoing']);
    }

    /**
     * Complete booking
     */
    public function complete(): bool
    {
        return $this->update(['status' => 'completed']);
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(string $status): bool
    {
        return $this->update(['payment_status' => $status]);
    }

    /**
     * Calculate remaining amount
     */
    public function calculateRemainingAmount(): float
    {
        return $this->total_price - $this->dp_amount;
    }

    /**
     * Scope: Get bookings by status
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Get bookings by payment status
     */
    public function scopeByPaymentStatus($query, string $paymentStatus)
    {
        return $query->where('payment_status', $paymentStatus);
    }

    /**
     * Scope: Get bookings by vehicle owner
     */
    public function scopeByVehicleOwner($query, int $ownerId)
    {
        return $query->whereHas('vehicle', function ($q) use ($ownerId) {
            $q->where('owner_id', $ownerId);
        });
    }

    /**
     * Scope: Get active bookings (pending, confirmed, ongoing)
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed', 'ongoing']);
    }

    /**
     * Get audit logs for this booking
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }

    public function autoUpdateStatusByDate(): void
{
    if ($this->status === 'cancelled') {
        return;
    }

    $today = Carbon::today();

    if ($today->lt($this->start_date)) {
        $this->update(['status' => 'confirmed']);
    } elseif ($today->between($this->start_date, $this->end_date)) {
        $this->update(['status' => 'ongoing']);
    } elseif ($today->gt($this->end_date)) {
        $this->update(['status' => 'completed']);
    }
}


}
