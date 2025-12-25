<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_code',
        'user_id',
        'photo_package_id',
        'payment_method',
        'payment_type',
        'proof_of_payment',
        'name',
        'address',
        'phone',
        'number_of_people',
        'photo_date',
        'photo_time',
        'reservation_status_id',
        'payment_status',
        'payment_amount',
        'notes',
        'admin_notes',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'photo_date' => 'date',
        'photo_time' => 'datetime:H:i',
        'payment_amount' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the user that owns the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the photo package for this reservation.
     */
    public function photoPackage()
    {
        return $this->belongsTo(PhotoPackage::class);
    }

    /**
     * Get the status of this reservation.
     */
    public function reservationStatus()
    {
        return $this->belongsTo(ReservationStatus::class);
    }

    /**
     * Get the admin who approved this reservation.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the album for this reservation.
     */
    public function album()
    {
        return $this->hasOne(Album::class);
    }

    /**
     * Generate a unique reservation code.
     */
    public static function generateReservationCode()
    {
        $date = now()->format('Ymd');
        $lastReservation = static::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();
        
        $number = $lastReservation ? (int) substr($lastReservation->reservation_code, -3) + 1 : 1;
        
        return 'GS-' . $date . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
