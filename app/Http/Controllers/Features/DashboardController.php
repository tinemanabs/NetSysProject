<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\Payments;
use App\Models\User;
use App\Models\UserRentals;
use App\Models\WebVisits;
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
        $totalWebVisits = WebVisits::distinct('ip_address')->count();
        $month = Carbon::now()->format('m');
        // $totalMonthlyBooking = Bookings::whereMonth('date_start', $month)->count();
        $totalSalesBooking = Payments::sum('total_paid');
        $totalSalesBookingFormat = number_format($totalSalesBooking, 2);
        $totalSalesPurchase = DB::table('user_rentals')
            ->where('item_payment_status', '1')
            ->selectRaw('SUM(quantity * price) as total')
            ->first();
        $totalSalesPurchaseFormat = number_format($totalSalesPurchase->total);
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
            'webVisits' => $totalWebVisits,
            'totalSalesBookingFormat' => $totalSalesBookingFormat,
            'totalSalesPurchaseFormat' => $totalSalesPurchaseFormat,

            'month' => $months,
            'nonExclusive' => $nonExclusive,
            'exclusive' => $exclusive,

            'time' => $time,
            'typeOfTime' => $typeOfTime

        ]);
    }
}
