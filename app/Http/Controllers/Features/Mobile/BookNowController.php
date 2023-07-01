<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
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
            $booking = Bookings::create([
                'room_id' => $request->room_id,
                'reservation_type' => $request->reservation_type,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'type' => $request->type,
                'adults' => $request->adults,
                'children' => $request->children,
                'place_pool' => $request->place_pool,
                'functional_hall' => $request->functional_hall,
                'inclusions' => $request->inclusions,
                'user_id' => $request->user_id,
            ]);

            DB::table('users')
                ->where('id', $request->user_id)
                ->update([
                    'is_booked' => true
                ]);

            DB::table('payments')
                ->insert([
                    'user_id' => $request->user_id,
                    'booking_id' => $booking->id,
                    'total_price' => $request->total_price,
                    'payment_status' => false,
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
            ->join('payments', 'bookings.id', 'payments.booking_id')
            ->where('bookings.user_id', $request->user_id)
            ->get();
    }

    public function getIndividualBooking(Request $request)
    {
        return DB::table('bookings')
            ->join('payments', 'bookings.id', 'payments.booking_id')
            ->where('bookings.id', $request->id)
            ->first();
    }

    public function cancelBooking(Request $request)
    {
        DB::table('bookings')
            ->where('id', $request->booking_id)
            ->delete();
        DB::table('payments')
            ->where('id', $request->id)
            ->delete();
        DB::table('users')
            ->where("id", $request->user_id)
            ->update([
                'is_booked' => NULL
            ]);
    }

    public function checkUserBooking(Request $request)
    {
        $checkIfBooked = DB::table('users')
            ->where('id', $request->user_id)
            ->first();

        $checkBookingToday = DB::table('bookings')
            ->join('users', 'bookings.user_id', 'users.id')
            ->where('users.id', $request->user_id)
            ->first();
        if ($checkIfBooked->is_booked == NULL) {
            return 'no booking';
        }

        if ($checkBookingToday->date_start != Carbon::create()->timezone('Asia/Manila')) {
            return "not today";
        } else {
            return "today";
        }
    }
}
