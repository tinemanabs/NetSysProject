<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomsAndCottagesController extends Controller
{
    public function getAllRoomsAndCottages()
    {
        return DB::table('rooms_and_cottages')
            ->get();
    }
}
