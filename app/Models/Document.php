<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document_number',
        'booking_id',
        'payment_id',
        'type',
        'file_path',
        'file_name',
        'generated_at',
        'generated_by',
        'regenerate_count',
        'last_regenerated_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'generated_at' => 'datetime',
            'last_regenerated_at' => 'datetime',
            'regenerate_count' => 'integer',
        ];
    }

    /**
     * Boot method to auto-generate document number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($document) {
            if (empty($document->document_number)) {
                $prefix = $document->type === 'receipt' ? 'RCP' : 'SIJ';
                $document->document_number = $prefix . '-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }

            if (empty($document->generated_at)) {
                $document->generated_at = now();
            }
        });
    }

    /**
     * Get the booking for this document
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * Get the payment for this document (for receipts)
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    /**
     * Get the user who generated this document
     */
    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    /**
     * Check if this is a receipt
     */
    public function isReceipt(): bool
    {
        return $this->type === 'receipt';
    }

    /**
     * Check if this is a travel permit
     */
    public function isTravelPermit(): bool
    {
        return $this->type === 'travel_permit';
    }

    /**
     * Regenerate document
     */
    public function regenerate(): self
    {
        $this->regenerate_count++;
        $this->last_regenerated_at = now();
        $this->save();

        return $this;
    }

    /**
     * Get full file path
     */
    public function getFullPathAttribute(): string
    {
        return storage_path('app/' . $this->file_path);
    }

    /**
     * Get download URL
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('documents.download', $this->id);
    }

    /**
     * Scope: Get documents by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope: Get receipts
     */
    public function scopeReceipts($query)
    {
        return $query->where('type', 'receipt');
    }

    /**
     * Scope: Get travel permits
     */
    public function scopeTravelPermits($query)
    {
        return $query->where('type', 'travel_permit');
    }

    /**
     * Scope: Get documents by booking
     */
    public function scopeByBooking($query, int $bookingId)
    {
        return $query->where('booking_id', $bookingId);
    }

    /**
     * Get audit logs for this document
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }
}
