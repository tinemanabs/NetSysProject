<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\RoomsAndCottages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomsAndCottagesController extends Controller
{
    public function showRoomsPage()
    {
        $rooms = DB::table('rooms_and_cottages')
            ->get();
        return view('features.rooms', [
            'rooms' => $rooms
        ]);
    }

    public function addRoom(Request $request)
    {

        $fileName = $request->room_id . '-' . $request->room_image->getClientOriginalName();
        $request->room_image->move(public_path('img/rooms/' . $request->room_id), $fileName);

        RoomsAndCottages::create([
            'room_id' => $request->room_id,
            'room_name' => $request->room_name,
            'room_cottage_price' => $request->room_price,
            'room_cottage_image' => $fileName,
        ]);
    }

    public function showCottagesPage()
    {
        $cottages = DB::table('rooms_and_cottages')
            ->get();
        return view('features.cottages', [
            'cottages' => $cottages
        ]);
    }

    public function addCottage(Request $request)
    {
        $fileName = $request->cottage_name . '-' . $request->cottage_image->getClientOriginalName();
        $request->cottage_image->move(public_path('img/cottages/' . $request->cottage_name), $fileName);

        RoomsAndCottages::create([
            'cottage_name' => $request->cottage_name,
            'room_cottage_price' => $request->cottage_price,
            'room_cottage_image' => $request->cottage_image,
            'room_cottage_image' => $fileName,
        ]);
    }
}
