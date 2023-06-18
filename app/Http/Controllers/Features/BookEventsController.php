<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookEventsController extends Controller
{
    public function index()
    {
        // retrive all the events booked by the users

        // if user_role == 1 or Admin - all events // else only their booking
        if (Auth::user()->user_role == 1) {
            $events = DB::table('bookings')
                ->join('users', 'users.id', '=', 'bookings.user_id')
                ->where('bookings.functional_hall', '!=', "0")
                ->where('bookings.inclusions', '!=', "0")
                ->select(
                    'bookings.*',
                    'users.email',
                    'users.first_name',
                    'users.last_name',
                    'users.birthday',
                    'users.address',
                )
                ->get();
        } else {
            $events = DB::table('bookings')
                ->join('users', 'users.id', '=', 'bookings.user_id')
                ->where('bookings.functional_hall', '!=', "0")
                ->where('bookings.user_id', Auth::user()->id)
                ->where('bookings.inclusions', '!=', "0")
                ->select(
                    'bookings.*',
                    'users.email',
                    'users.first_name',
                    'users.last_name',
                    'users.birthday',
                    'users.address',
                )
                ->get();
        }
        //return $events;
        return view('features.bookevents', [
            'events' => $events
        ]);
    }
}
