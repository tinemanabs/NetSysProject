<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\RoomsAndCottages;
use Illuminate\Http\Request;

class BookNowController extends Controller
{
    public function index()
    {
        $rooms = RoomsAndCottages::all()->where('cottage_name', NULL);
        $cottages = RoomsAndCottages::all()->where('room_id', NULL);
        return view('app.booknow', [
            'rooms' => $rooms,
            'cottages' => $cottages
        ]);
    }
}
