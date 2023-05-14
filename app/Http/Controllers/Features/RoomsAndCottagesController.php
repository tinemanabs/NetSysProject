<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\RoomsAndCottages;
use Illuminate\Http\Request;

class RoomsAndCottagesController extends Controller
{
    public function showRoomsPage()
    {
        return view('features.rooms');
    }

    public function addRoom(Request $request)
    {
        RoomsAndCottages::create([
            'room_id' => $request->room_id,
            'room_name' => $request->room_name,
            'type_of_rent' => 'room',
            'room_cottage_price' => $request->room_price
        ]);
    }

    public function showCottagesPage()
    {
        return view('features.cottages');
    }

    public function addCottage(Request $request)
    {
        RoomsAndCottages::create([
            'cottage_name' => $request->cottage_name,
            'type_of_rent' => 'cottage',
            'room_cottage_price' => $request->cottage_price
        ]);
    }
}
