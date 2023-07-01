<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'description',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
