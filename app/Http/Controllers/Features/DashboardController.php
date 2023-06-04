<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // cards
        $users = User::where('user_role', 2)->count();
        $now = Carbon::now()->format('Y-m-d');
        $bookingToday = Bookings::where('date_start', $now)->count();
        $month = Carbon::now()->format('m');
        $totalMonthlyBooking = Bookings::whereMonth('date_start', $month)->count();
        $totalBookings = Bookings::all()->count();

        //chart js
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        //for line graph
        $nonExclusive = [];
        foreach ($months as $key => $value) {
            $nonExclusive[] =
                Bookings::where('reservation_type', 'non-exclusive')
                ->where(\DB::raw('DATE_FORMAT(date_start, "%M")'), $value)
                ->count();
        }

        $exclusive = [];
        foreach ($months as $key => $value) {
            $exclusive[] =
                Bookings::where('reservation_type', 'exclusive')
                ->where(\DB::raw('DATE_FORMAT(date_start, "%M")'), $value)
                ->count();
        }

        //pie graph
        $time = ['day', 'night', 'overnight'];

        $typeOfTime = [];
        foreach ($time as $key => $value) {
            $typeOfTime[] = Bookings::where('type', $value)
                ->count();
        }

        return view('features.dashboard', [
            'users' => $users,
            'bookingToday' => $bookingToday,
            'totalMonthlyBooking' => $totalMonthlyBooking,
            'totalBookings' => $totalBookings,

            'month' => $months,
            'nonExclusive' => $nonExclusive,
            'exclusive' => $exclusive,

            'time' => $time,
            'typeOfTime' => $typeOfTime

        ]);
    }
}
