<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Mail\SendCancelBooking;
use App\Models\Bookings;
use App\Models\BookingViolations;
use App\Models\Payments;
use App\Models\RoomsAndCottages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $users = User::where('user_role', 2)->get();
        return view('features.addbooking', compact('users'));
    }

    public function adminAddBooking(Request $request)
    {

        if ($request->user_role == 1) {
            // SAVING FOR ADMIN SIDE - WALK IN GUEST
            if ($request->user_account_status == 'registered_user') {
                // have accounts in the system 
                User::where('id', $request->registered_user_id)->update(['is_booked' => 1]);
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
                    'user_id' => $request->registered_user_id,
                ]);

                if ($request->payment_type == 'Full Payment') {
                    $payment = Payments::create([
                        'user_id' => $request->registered_user_id,
                        'booking_id' => $booking->id,
                        'total_paid' => $request->total_price,
                        'total_price' => $request->total_price,
                        'payment_type' => $request->payment_type,
                        'payment_status' => 1,
                        'payment_image' => NULL, // should be null bc there's a cash option
                    ]);
                } else if ($request->payment_type == 'Down Payment') {
                    $payment = Payments::create([
                        'user_id' => $request->registered_user_id,
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
                    $request->payment_image->move(public_path('img/payments/' . $request->registered_user_id), $receiptImage);
                    $payment->update(['payment_image' => $receiptImage]);
                }
            } else {
                // dont have accounts in the system
                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'birthday' => $request->birthday,
                    'email' => $request->email,
                    'address' => $request->address,
                    'contact_no' => $request->contact_no,
                    'password' => Hash::make($request->password),
                    'user_role' => 2,
                    'email_verified_at' => now(),
                    'is_notify' => NULL,
                    'is_booked' => 1
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
            }

            //note: don't use same email address
        } else if ($request->user_role == 2) {
            // SAVING FOR THOSE WHO HAVE ALREADY ACCTS
            User::where('id', $request->user)->update(['is_booked' => 1]);
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

    public function viewBooking($id)
    {
        $getAllBookings = DB::table('bookings')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('payments', 'payments.booking_id', '=', 'bookings.id')
            ->where('bookings.id', $id)
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
            ->first();
        $purchaseAndRentals = DB::table("user_rentals")
            ->join('purchase_and_rentals', 'purchase_and_rentals.id', 'user_rentals.rental_id')
            ->where('user_rentals.user_id', $getAllBookings->user_id)
            ->get();
        $violations = BookingViolations::where('booking_id', $id)->get();
        $rooms = DB::table('rooms_and_cottages')
            ->select(
                'id',
                'room_name',
                'cottage_name'
            )
            ->get();
        //return $getAllBookings;

        return view('features.booking.viewbooking', [
            'booking' => $getAllBookings,
            'rooms' => $rooms,
            'purchaseAndRentals' => $purchaseAndRentals,
            'violations' => $violations,
        ]);
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

    public function getDisabledDates(Request $request)
    {
        $disabledDates = DB::table('bookings')
            ->where('reservation_type', 'exclusive')
            ->where('place_pool', $request->input('place_of_pool'))
            ->where('type', $request->input('timeBooked'))
            ->pluck('date_start')
            ->toArray();
        return response()->json($disabledDates);
    }

    public function getDisabledEditDates(Request $request)
    {
        $disabledDates = DB::table('bookings')
            ->where('reservation_type', 'exclusive')
            ->where('place_pool', $request->input('place_of_pool'))
            ->where('type', $request->input('timeBooked'))
            ->where('id', '!=', $request->input('booking_id'))
            ->pluck('date_start')
            ->toArray();
        return response()->json($disabledDates);
    }

    public function getFilteredRooms(Request $request)
    {
        $filteredRooms = DB::table('bookings')
            ->where('date_start', $request->date_Start)
            ->where('place_pool',  $request->place_of_pool)
            ->where('type', $request->timeBooked)
            ->pluck('room_id')
            ->toArray();

        $singleArrayRooms = array_reduce($filteredRooms, function ($carry, $item) {
            $decoded = json_decode($item, true);
            return array_merge($carry, $decoded);
        }, []);

        $rooms = DB::table('rooms_and_cottages')
            ->where('cottage_name', NULL)
            ->where('place_room_cottage',  $request->place_of_pool)
            ->whereNotIn('id', $singleArrayRooms)
            ->get();

        return response()->json($rooms);
    }

    public function getFilteredCottages(Request $request)
    {
        $filteredCottages = DB::table('bookings')
            ->where('date_start', $request->date_Start)
            ->where('place_pool',  $request->place_of_pool)
            ->where('type', $request->timeBooked)
            ->pluck('room_id')
            ->toArray();

        $singleArrayCottages = array_reduce($filteredCottages, function ($carry, $item) {
            $decoded = json_decode($item, true);
            return array_merge($carry, $decoded);
        }, []);

        $cottages = DB::table('rooms_and_cottages')
            ->where('room_id', NULL)
            ->where('place_room_cottage',  $request->place_of_pool)
            ->whereNotIn('id', $singleArrayCottages)
            ->get();

        return response()->json($cottages);
    }

    public function getUserID($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json($user);
    }

    public function editBooking($id)
    {
        $booking =  DB::table('bookings')
            ->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('payments', 'payments.booking_id', '=', 'bookings.id')
            ->where('bookings.id', $id)
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
            ->first();

        $rooms = RoomsAndCottages::all();
        $roomsResult = Bookings::where('id', $id)->pluck('room_id')->toArray();

        // for JS Rooms or cottage info
        $roomsArray = [];
        foreach ($rooms as $room) {
            if (in_array($room->id, json_decode($roomsResult[0]))) {
                $roomsArray[] = $room->room_id . $room->cottage_name;
            }
        }
        $roomsStr = implode(', ', $roomsArray);

        // for JS Rooms or cottage price info 

        $roomsPriceArray = [];
        foreach ($rooms as $room) {
            if (in_array($room->id, json_decode($roomsResult[0]))) {
                $roomsPriceArray[] = $room->room_cottage_price;
            }
        }

        $totalRoomPriceArr = array_sum($roomsPriceArray);

        //return $totalRoomPriceArr;
        return view('features.booking.editbooking', compact('booking', 'rooms', 'roomsStr', 'totalRoomPriceArr'));
    }

    public function updateBooking(Request $request, $id)
    {
        Bookings::where('id', $id)->update([
            'place_pool' => $request->place_pool,
            'type' => $request->time,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'adults' => $request->adults,
            'children' => $request->children
        ]);

        Payments::where('booking_id', $id)->update([
            'total_price' => $request->total_price
        ]);
    }

    public function updateCompleteBooking(Request $request)
    {
        Bookings::where('id', $request->id)->update([
            'booking_status' => $request->booking_status
        ]);

        User::where('id', $request->user_id)->update([
            'is_booked' => NULL
        ]);
    }

    public function cancelBooking(Request $request)
    {
        Bookings::where('id', $request->book_id)->update([
            'booking_status' => 'Canceled',
        ]);

        User::where('id', $request->user_id)->update([
            'is_booked' => NULL
        ]);

        $details = [
            'reservation_type' => $request->reservation_type,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'time' => $request->time,
            'pool' => $request->pool,
            'name' => $request->name,
        ];

        Mail::to($request->email)->send(new SendCancelBooking($details));
    }
}
