<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'total_paid',
        'total_price',
        'payment_type',
        'payment_status',
        'payment_image',
    ];
}
