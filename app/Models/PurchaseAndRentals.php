<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseAndRentals extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'item_description',
        'item_price',
        'item_count',
        'item_image'
    ];
}
