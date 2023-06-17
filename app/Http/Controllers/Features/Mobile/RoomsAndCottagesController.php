<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\each;

class RoomsAndCottagesController extends Controller
{
    public function getAllRoomsAndCottages()
    {
        return DB::table('rooms_and_cottages')
            ->get();
    }

    public function getFilteredRooms(Request $request)
    {
        // $start = Carbon::create($request->start_date)->toDateString();
        // $end = Carbon::create($request->end_date)->toDateString();
        // $period = CarbonPeriod::create($start, $end);
        // $formattedPeriod = [];
        // foreach ($period as $date) {
        //     array_push($formattedPeriod, Carbon::create($date)->toDateString());
        // }
        // // $bookings = Bookings::all()->filter(function ($item) {
        // //     if (Carbon::now()->between($item->from))
        // // })
        // $bookings = DB::table("bookings")
        //     ->where('type', $request->type)
        //     ->get();

        // $temp = [];

        // foreach ($bookings as $booking) {
        //     $bookingStart = $booking->date_start;
        //     $bookingEnd = $booking->date_end;
        //     $bookingPeriod = CarbonPeriod::create($bookingStart, $bookingEnd);
        //     $formattedBookingPeriod = [];

        //     foreach ($bookingPeriod as $bp) {
        //         array_push($formattedBookingPeriod, Carbon::create($bp)->toDateString());
        //     }
        //     foreach ($formattedPeriod as $fp) {
        //         if (in_array($fp, $formattedBookingPeriod)) {
        //             return $fp;
        //         }
        //     }
        // }


        return DB::table('rooms_and_cottages')
            ->get();
    }
}
