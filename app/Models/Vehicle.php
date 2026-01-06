<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'type',
        'name',
        'license_plate',
        'brand',
        'year',
        'seat_capacity',
        'status',
        'facilities',
        'description',
        'price_per_day',
        'image',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'facilities' => 'array',
            'price_per_day' => 'decimal:2',
            'year' => 'integer',
            'seat_capacity' => 'integer',
        ];
    }

    /**
     * Get the owner (Admin Bus or Admin Travel) of this vehicle
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get schedules for this vehicle
     */
    public function schedules()
    {
        return $this->hasMany(VehicleSchedule::class, 'vehicle_id');
    }

    /**
     * Get bookings for this vehicle
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'vehicle_id');
    }

    /**
     * Check if vehicle is available
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    /**
     * Check if vehicle is booked
     */
    public function isBooked(): bool
    {
        return $this->status === 'booked';
    }

    /**
     * Check if vehicle is in maintenance
     */
    public function isInMaintenance(): bool
    {
        return $this->status === 'maintenance';
    }

    /**
     * Check if vehicle is a bus
     */
    public function isBus(): bool
    {
        return $this->type === 'bus';
    }

    /**
     * Check if vehicle is a travel car
     */
    public function isTravelCar(): bool
    {
        return $this->type === 'travel_car';
    }

    /**
     * Set vehicle status to available
     */
    public function setAvailable(): bool
    {
        return $this->update(['status' => 'available']);
    }

    /**
     * Set vehicle status to booked
     */
    public function setBooked(): bool
    {
        return $this->update(['status' => 'booked']);
    }

    /**
     * Set vehicle status to maintenance
     */
    public function setMaintenance(): bool
    {
        return $this->update(['status' => 'maintenance']);
    }

    /**
     * Scope: Get only available vehicles
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Scope: Get vehicles by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope: Get vehicles by owner
     */
    public function scopeByOwner($query, int $ownerId)
    {
        return $query->where('owner_id', $ownerId);
    }

    /**
     * Get audit logs for this vehicle
     */
    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'auditable');
    }
}
