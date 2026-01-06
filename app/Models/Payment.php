<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'payment_code',
        'booking_id',
        'payment_type',
        'amount',
        'payment_method',
        'bank_name',
        'account_number',
        'account_holder',
        'status',
        'payment_proof',
        'notes',
        'payment_date',
        'confirmed_at',
        'confirmed_by',
        'cancelled_at',
        'cancelled_by',
        'cancellation_reason',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'payment_date' => 'datetime',
            'confirmed_at' => 'datetime',
            'cancelled_at' => 'datetime',
        ];
    }

    /**
     * Boot method to auto-generate payment code
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->payment_code)) {
                $payment->payment_code = 'PAY-' . strtoupper(Str::random(10));
            }
        });
    }

    /**
     * Get the booking for this payment
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * Get the user who confirmed this payment
     */
    public function confirmer()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    /**
     * Get the user who cancelled this payment
     */
    public function canceller()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    /**
     * Get documents for this payment
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'payment_id');
    }

    /**
     * Check if payment is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payment is confirmed
     */
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if payment is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if this is a DP payment
     */
    public function isDp(): bool
    {
        return $this->payment_type === 'dp';
    }

    /**
     * Check if this is a full payment
     */
    public function isFullPayment(): bool
    {
        return $this->payment_type === 'full_payment';
    }

    /**
     * Check if this is a remaining payment
     */
    public function isRemainingPayment(): bool
    {
        return $this->payment_type === 'remaining_payment';
    }

    /**
     * Confirm payment
     */
    public function confirm(int $confirmedBy): bool
    {
        $result = $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'confirmed_by' => $confirmedBy,
        ]);

        if ($result) {
            // Update booking payment status
            $booking = $this->booking;

            if ($this->isDp()) {
                $booking->updatePaymentStatus('dp_paid');
            } elseif ($this->isFullPayment() || $this->isRemainingPayment()) {
                $booking->updatePaymentStatus('fully_paid');
            }
        }

        return $result;
    }

    /**
     * Cancel payment
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
     * Scope: Get payments by status
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Get payments by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('payment_type', $type);
    }

    /**
     * Scope: Get payments by booking
     */
    public function scopeByBooking($query, int $bookingId)
    {
        return $query->where('booking_id', $bookingId);
    }

    /**
     * Scope: Get payments by vehicle owner
     */
    public function scopeByVehicleOwner($query, int $ownerId)
    {
        return $query->whereHas('booking.vehicle', function ($q) use ($ownerId) {
            $q->where('owner_id', $ownerId);
        });
    }

    /**
     * Scope: Get confirmed payments
     */
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    /**
     * Get audit logs for this payment
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }
}
