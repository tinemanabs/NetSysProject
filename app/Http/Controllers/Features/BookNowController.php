<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\RoomsAndCottages;
use Illuminate\Http\Request;

class BookNowController extends Controller
{
    public function index()
    {
        $rooms = RoomsAndCottages::all()->where('cottage_name', NULL);
        $cottages = RoomsAndCottages::all()->where('room_id', NULL);
        return view('features.booknow', [
            'rooms' => $rooms,
            'cottages' => $cottages
        ]);
    }

    public function addBooking(Request $request)
    {
        Bookings::create([
            'room_id' => $request->room_id,
            'date_start' => $request->date,
            'date_end' => $request->date,
            'is_half' => '0',
            'type' => $request->day,
            'adults' => $request->adults,
            'children' => $request->children,
            'user_id' => $request->user,
        ]);

        //dd($user);
    }
}
