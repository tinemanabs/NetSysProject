<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalsController extends Controller
{
    public function getAllRentals()
    {
        return DB::table('purchase_and_rentals')
            ->get();
    }
}
