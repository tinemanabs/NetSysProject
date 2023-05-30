<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function submitPayment(Request $request)
    {
        if ($request->hasFile('payment_image')) {
            // return $request;
            $fileName = $request->file('payment_image')->getClientOriginalName();
            $request->file('payment_image')->move(public_path('img/payments/' . $request->user_id . '/'), $fileName);
            $payment = DB::table('payments')
                ->where('booking_id', (int)$request->booking_id)
                ->update([
                    'total_paid' => (string)$request->total_paid,
                    'payment_status' => (bool)$request->payment_status,
                    'payment_type' => $request->payment_type,
                    'payment_image' => $fileName
                ]);
            return $payment;
        } else {
            return 'false';
        }
    }
}
