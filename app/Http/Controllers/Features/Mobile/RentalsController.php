<?php

namespace App\Http\Controllers\Features\Mobile;

use App\Http\Controllers\Controller;
use App\Models\UserRentals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalsController extends Controller
{
    public function getAllRentals()
    {
        return DB::table('purchase_and_rentals')
            ->get();
    }

    public function addPurchaseAndRentals(Request $request)
    {
        // return $request;
        $checkStock = DB::table('purchase_and_rentals')
            ->where('id', $request->rental_id)
            ->first();
        if ($checkStock->item_count == 0) {
            return "no stock";
        } else {
            UserRentals::create([
                'user_id' => $request->user_id,
                "rental_id" => $request->rental_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'item_payment_status' => 0
            ]);

            $newStock = (int)$checkStock->item_count - 1;

            DB::table("purchase_and_rentals")
                ->where("id", $request->rental_id)
                ->update([
                    'item_count' => (string)$newStock
                ]);
            return 'true';
        }
    }

    public function getUserPurchaseAndRentals(Request $request)
    {
        $userRentals = DB::table('purchase_and_rentals')
            ->join('user_rentals', 'purchase_and_rentals.id', 'user_rentals.rental_id')
            ->where('user_rentals.user_id', $request->user_id)
            ->whereNull('user_rentals.item_payment_image')
            ->get();

        return $userRentals;
    }

    public function addPurchaseAndRentalsQuantity(Request $request)
    {
        $rental = DB::table('purchase_and_rentals')
            ->join('user_rentals', 'purchase_and_rentals.id', 'user_rentals.rental_id')
            ->where('user_rentals.user_id', $request->user_id)
            ->where('user_rentals.id', $request->id)
            ->first();

        if ($rental->item_count >= $rental->quantity) {
            DB::table("user_rentals")
                ->where('id', $request->id)
                ->update([
                    'quantity' => (int)$request->quantity + 1,
                    'price' => (int)$rental->price + (int)$rental->item_price
                ]);
            DB::table('purchase_and_rentals')
                ->where('id', $rental->rental_id)
                ->update([
                    'item_count' => (int)$rental->item_count - 1
                ]);

            return 'true';
        } else {
            return 'false';
        }
    }

    public function subtractPurchaseAndRentalsQuantity(Request $request)
    {
        $rental = DB::table('purchase_and_rentals')
            ->join('user_rentals', "purchase_and_rentals.id", "user_rentals.rental_id")
            ->where('user_rentals.user_id', $request->user_id)
            ->where("user_rentals.id", $request->id)
            ->first();

        if ($rental->item_count != 0) {
            DB::table('user_rentals')
                ->where('id', $request->id)
                ->update([
                    'quantity' => (int)$request->quantity - 1,
                    'price' => (int)$rental->price - (int)$rental->item_price
                ]);
            DB::table('purchase_and_rentals')
                ->where('id', $rental->rental_id)
                ->update([
                    'item_count' => (int)$rental->item_count + 1
                ]);
            return 'true';
        } else {
            return 'false';
        }

        return $rental;
    }

    public function removePurchaseAndRentals(Request $request)
    {
        // return $request;

        $rental = DB::table('purchase_and_rentals')
            ->join('user_rentals', "purchase_and_rentals.id", "user_rentals.rental_id")
            ->where('user_rentals.user_id', $request->user_id)
            ->where("user_rentals.id", $request->id)
            ->first();

        DB::table('purchase_and_rentals')
            ->where('id', $rental->rental_id)
            ->update([
                'item_count' => (int)$rental->item_count + 1
            ]);

        $rental = DB::table('user_rentals')
            ->where('id', $request->id)
            ->delete();
    }

    public function submitPurchaseAndRentalsPayment(Request $request)
    {
        if ($request->hasFile('item_payment_image')) {
            $fileName = $request->file("item_payment_image")->getClientOriginalName();
            $request->file('item_payment_image')->move(public_path('img/payments/', $request->user_id . '/'), $fileName);
            foreach (json_decode($request->id) as $id) {
                DB::table('user_rentals')
                    ->where('id', $id)
                    ->update([
                        'item_payment_image' => $fileName
                    ]);
            }
            return 'true';
        } else {
            return 'false';
        }
    }
}
