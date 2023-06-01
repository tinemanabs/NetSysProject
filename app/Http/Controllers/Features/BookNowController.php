<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\Bookings;
use App\Models\Payments;
use App\Models\RoomsAndCottages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BookNowController extends Controller
{
    public function index()
    {
        $getAllBookings = DB::table('bookings')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('payments', 'payments.booking_id', '=', 'bookings.id')
            //->join('rooms_and_cottages', 'rooms_and_cottages.id', '=', 'bookings.room_id')
            ->select(
                'bookings.*',
                'users.email',
                'users.first_name',
                'users.last_name',
                'users.birthday',
                'users.address',
                'users.contact_no',
                'payments.total_paid',
                'payments.total_price',
                'payments.payment_type',
                'payments.payment_status',
                'payments.payment_image',

            )
            ->get();

        $getMyBookings = DB::table('bookings')
            ->where('bookings.user_id', Auth::user()->id)
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('payments', 'payments.booking_id', '=', 'bookings.id')
            //->join('rooms_and_cottages', 'rooms_and_cottages.id', '=', 'bookings.room_id')
            ->select(
                'bookings.*',
                'users.email',
                'users.first_name',
                'users.last_name',
                'users.birthday',
                'users.address',
                'users.contact_no',
                'payments.total_paid',
                'payments.total_price',
                'payments.payment_type',
                'payments.payment_status',
                'payments.payment_image',
            )
            ->get();

        $rooms = DB::table('rooms_and_cottages')
            ->select(
                'id',
                'room_name',
                'cottage_name'
            )
            ->get();

        //dd($getMyBookings);
        //return $getAllBookings;
        return view('features.booknow', [
            'allBookings' => $getAllBookings,
            'myBooking' => $getMyBookings,
            'rooms' => $rooms
        ]);
    }

    public function addBooking()
    {
        return view('features.addbooking');
    }

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
                'room_id' => $request->room_cottage_id,
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

            if ($request->payment_type == 'Full Payment') {
                $payment = Payments::create([
                    'user_id' => $user->id,
                    'booking_id' => $booking->id,
                    'total_paid' => $request->total_price,
                    'total_price' => $request->total_price,
                    'payment_type' => $request->payment_type,
                    'payment_status' => 1,
                    'payment_image' => NULL, // should be null bc there's a cash option
                ]);
            } else if ($request->payment_type == 'Down Payment') {
                $payment = Payments::create([
                    'user_id' => $user->id,
                    'booking_id' => $booking->id,
                    'total_paid' => $request->down_payment, // change base if full payment or downpayment
                    'total_price' => $request->total_price,
                    'payment_type' => $request->payment_type,
                    'payment_status' => 1,
                    'payment_image' => NULL,
                ]);
            }

            if ($request->hasFile('payment_image')) {
                $receiptImage = $request->payment_image->getClientOriginalName();
                $request->payment_image->move(public_path('img/payments/' . $user->id), $receiptImage);
                $payment->update(['payment_image' => $receiptImage]);
            }

            //note: don't use same email address
        } else if ($request->user_role == 2) {
            // SAVING FOR THOSE WHO HAVE ALREADY ACCTS
            $booking = Bookings::create([
                'room_id' => $request->room_cottage_id,
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

            $receiptImage = $request->payment_image->getClientOriginalName();
            $request->payment_image->move(public_path('img/payments/' . $request->user), $receiptImage);

            if ($request->payment_type == 'Full Payment') {
                //changes in total paid if different payment type
                Payments::create([
                    'user_id' => $request->user,
                    'booking_id' => $booking->id,
                    'total_paid' => $request->total_price,
                    'total_price' => $request->total_price,
                    'payment_type' => $request->payment_type,
                    'payment_status' => 0,
                    'payment_image' => $receiptImage,
                ]);
            } else if ($request->payment_type == 'Down Payment') {
                Payments::create([
                    'user_id' => $request->user,
                    'booking_id' => $booking->id,
                    'total_paid' => $request->down_payment,
                    'total_price' => $request->total_price,
                    'payment_type' => $request->payment_type,
                    'payment_status' => 0,
                    'payment_image' => $receiptImage,
                ]);
            }
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

    public function approvePaymentStatus($id)
    {
        Payments::where('booking_id', $id)->update([
            'payment_status' => 1
        ]);
    }

    public function checkFullPayment(Request $request, $id)
    {
        Payments::where('booking_id', $id)->update([
            'payment_type' => 'Full Payment',
            'total_paid' => $request->total_price
        ]);
    }

    public function deleteBooking($id)
    {
        Bookings::find($id)->delete();
        Payments::where('booking_id', $id)->delete();
    }
}
