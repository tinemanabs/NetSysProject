<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRentals extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rental_id',
        'quantity',
        'price',
        'item_payment_status',
        'item_payment_image',
    ];
}
