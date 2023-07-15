<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\BookingViolations;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingViolationsController extends Controller
{
    public function index()
    {
        $bookingsToday = DB::table('users')
            ->join('bookings', 'bookings.user_id', 'users.id')
            ->where('bookings.date_start', Carbon::now()->timezone("Asia/Manila")->toDateString())
            ->get();
        $violations = BookingViolations::all();
        return view('features.bookingviolations.bookingviolations', [
            'violations' => $violations,
            'bookingsToday' => $bookingsToday
        ]);
    }

    public function getSelectedBookingUser($id)
    {
        return DB::table('bookings')
            ->where("id", $id)
            ->first();
    }

    public function addViolation(Request $request)
    {
        BookingViolations::create([
            'booking_id' => $request->booking_id,
            'user_id' => $request->user_id,
            'violation_price' => $request->violation_price,
            'violation_description' => $request->violation_description,
        ]);
    }

    public function deleteViolation(Request $request)
    {
        BookingViolations::findOrFail($request->id)->delete();
    }

    public function editViolation(Request $request)
    {
        BookingViolations::findOrFail($request->id)->update([
            'violation_price' => $request->violation_price,
            'violation_description' => $request->violation_description,
        ]);
    }


    // * NOTE: MOBILE FUNCTIONS

    public function getBookingViolations(Request $request)
    {
        return $request;
    }
}
