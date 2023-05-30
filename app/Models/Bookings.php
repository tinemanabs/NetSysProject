<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'reservation_type',
        'date_start',
        'date_end',
        'type',
        'place_pool',
        'adults',
        'children',
        'user_id',
        'functional_hall',
        'inclusions'
    ];
}
