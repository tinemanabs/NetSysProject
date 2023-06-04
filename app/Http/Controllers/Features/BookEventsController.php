<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookEventsController extends Controller
{
    public function index()
    {
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

        //return $events;
        return view('features.bookevents', [
            'events' => $events
        ]);
    }
}
