<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleSchedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle_id',
        'date',
        'departure_time',
        'arrival_time',
        'departure_location',
        'arrival_location',
        'status',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'departure_time' => 'datetime',
            'arrival_time' => 'datetime',
        ];
    }

    /**
     * Get the vehicle for this schedule
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    /**
     * Get bookings for this schedule
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'schedule_id');
    }

    /**
     * Check if schedule is active (scheduled or ongoing)
     */
    public function isActive(): bool
    {
        return in_array($this->status, ['scheduled', 'ongoing']);
    }

    /**
     * Check if schedule is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if schedule is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Set schedule status to ongoing
     */
    public function setOngoing(): bool
    {
        return $this->update(['status' => 'ongoing']);
    }

    /**
     * Set schedule status to completed
     */
    public function setCompleted(): bool
    {
        return $this->update(['status' => 'completed']);
    }

    /**
     * Set schedule status to cancelled
     */
    public function setCancelled(): bool
    {
        return $this->update(['status' => 'cancelled']);
    }

    /**
     * Scope: Get schedules by date
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }

    /**
     * Scope: Get active schedules
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['scheduled', 'ongoing']);
    }

    /**
     * Scope: Get schedules by vehicle
     */
    public function scopeByVehicle($query, int $vehicleId)
    {
        return $query->where('vehicle_id', $vehicleId);
    }

    /**
     * Get audit logs for this schedule
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }
}
