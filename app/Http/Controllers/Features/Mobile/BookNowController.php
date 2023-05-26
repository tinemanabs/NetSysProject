<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookNowController extends Controller
{
    public function addBooking(Request $request)
    {
        DB::table('bookings')
            ->insert([
                'room_id' => $request->room_id,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'type' => $request->type,
                'adults' => $request->adults,
                'children' => $request->children,
                'user_id' => $request->user_id,
            ]);
        return $request;
    }
}
