<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookNowController extends Controller
{
    public function filterDates(Request $request)
    {
        $start = Carbon::create($request->start_date)->toDateString();
        $end = Carbon::create($request->end_date)->toDateString();

        $bookedDates = DB::table('bookings')
            ->whereBetween('date_start', [$start, $end])
            ->whereBetween('date_end', [$start, $end])
            ->where('type', $request->type)
            ->get();
        return $bookedDates;
    }

    public function addBooking(Request $request)
    {
        $start = Carbon::create($request->date_start)->setTimezone('Asia/Singapore')->toDateString();
        $end = Carbon::create($request->date_end)->setTimezone('Asia/Singapore')->toDateString();

        $exist = DB::table('bookings')
            ->where('date_start', $start)
            ->where('date_end', $end)
            ->where("type", $request->type)
            ->get();
        if (count($exist) == 0) {
            DB::table('bookings')
                ->insert([
                    'room_id' => $request->room_id,
                    'reservation_type' => $request->reservation_type,
                    'date_start' => $request->date_start,
                    'date_end' => $request->date_end,
                    'type' => $request->type,
                    'adults' => $request->adults,
                    'children' => $request->children,
                    'functional_hall' => $request->functional_hall,
                    'inclusions' => $request->inclusions,
                    'user_id' => $request->user_id,
                ]);
            return 'true';
        } else {
            return 'false';
        }

        // return $request;
    }

    public function getUserBooking(Request $request)
    {
        return DB::table('bookings')
            ->where('user_id', $request->user_id)
            ->get();
    }

    public function getIndividualBooking(Request $request)
    {
        return DB::table('bookings')
            ->where('id', $request->id)
            ->first();
    }
}
