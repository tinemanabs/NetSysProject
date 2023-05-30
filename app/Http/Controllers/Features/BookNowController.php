<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\Payments;
use App\Models\RoomsAndCottages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function addBooking()
    {
        return view('features.addbooking');
    }

    // public function addBooking(Request $request)
    // {
    //     Bookings::create([
    //         'room_id' => $request->room_id,
    //         'date_start' => $request->date,
    //         'date_end' => $request->date,
    //         'is_half' => '0',
    //         'type' => $request->day,
    //         'adults' => $request->adults,
    //         'children' => $request->children,
    //         'user_id' => $request->user,
    //     ]);

    //     //dd($user);
    // }

    public function adminAddBooking(Request $request)
    {
        if ($request->user_role == 1) {
            // SAVING FOR ADMIN SIDE - WALK IN GUEST
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

            $booking = Bookings::create([
                'room_id' => json_encode($request->room_cottage_id), // note: ask rob how to save array
                'reservation_type' => $request->reservation_type,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'type' => $request->time,
                'place_pool' => $request->place_pool,
                'adults' => $request->adults,
                'children' => $request->children,
                'functional_hall' => $request->event,
                'inclusions' => $request->inclusions,
                'user_id' => $user->id,
            ]);

            if ($request->mode_of_payment === 'cash') {
                Payments::create([
                    'user_id' => $user->id,
                    'booking_id' => $booking->id,
                    'total_paid' => $request->total_price,
                    'total_price' => $request->total_price,
                    'payment_type' => $request->mode_of_payment,
                    'payment_status' => 1, //1=paid, 0=not yet
                    'payment_image' => NULL,
                ]);
            } else if ($request->mode_of_payment === 'gcash') {
                Payments::create([
                    'user_id' => $user->id,
                    'booking_id' => $booking->id,
                    'total_paid' => $request->total_price,
                    'total_price' => $request->total_price,
                    'payment_type' => $request->mode_of_payment,
                    'payment_status' => 0,
                    'payment_image' => $request->payment_image,
                ]);
            }

            //note: don't use same email address
        } else if ($request->user_role == 2) {
            // SAVING FOR THOSE WHO HAVE ALREADY ACCTS
            $booking = Bookings::create([
                'room_id' => json_encode($request->room_cottage_id), // note: ask rob how to save array
                'reservation_type' => $request->reservation_type,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'type' => $request->time,
                'place_pool' => $request->place_pool,
                'adults' => $request->adults,
                'children' => $request->children,
                'functional_hall' => $request->event,
                'inclusions' => $request->inclusions,
                'user_id' => $request->user,
            ]);

            Payments::create([
                'user_id' => $request->user,
                'booking_id' => $booking->id,
                'total_paid' => $request->total_price,
                'total_price' => $request->total_price,
                'payment_type' => $request->mode_of_payment,
                'payment_status' => 0,
                'payment_image' => $request->payment_image,
            ]);
        }
    }

    public function getRooms($place)
    {
        $filteredRooms = DB::table('rooms_and_cottages')
            ->where('place_room_cottage', $place)
            ->where('cottage_name', NULL)
            ->get();
        return $filteredRooms;
    }

    public function getCottages($place)
    {
        $filteredCottages = DB::table('rooms_and_cottages')
            ->where('place_room_cottage', $place)
            ->where('room_id', NULL)
            ->get();

        return $filteredCottages;
    }
}
