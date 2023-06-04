<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsAndCottages extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'room_name',
        'cottage_name',
        'type_of_rent',
        'place_room_cottage',
        'room_cottage_price',
        'room_cottage_image',
    ];
}
