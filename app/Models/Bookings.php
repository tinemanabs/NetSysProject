<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'date_start',
        'date_end',
        'is_half',
        'type',
        'adults',
        'children',
        'user_id',
    ];
}
