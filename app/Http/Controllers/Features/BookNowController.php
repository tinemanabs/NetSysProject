<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\RoomsAndCottages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function adminAddBooking(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'email' => $request->email,
            'address' => $request->address,
            'contact_no' => $request->contact_no,
            'password' => Hash::make($request->password),
            'user_role' => 2,
            'is_notify' => NULL,
            'is_booked' => NULL
        ]);

        Bookings::create([
            'room_id' => $request->room_cottage_id,
            'date_start' => $request->date,
            'date_end' => $request->date,
            'type' => $request->day,
            'adults' => $request->adults,
            'children' => $request->children,
            'user_id' => $user->id,
        ]);
    }
}
