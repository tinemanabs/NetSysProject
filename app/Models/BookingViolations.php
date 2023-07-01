<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingViolations extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'violation_price',
        'violation_description',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userBooking()
    {
        return $this->belongsTo(Bookings::class, 'booking_id', 'id');
    }
}
