<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\UserRentals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseAndRental extends Controller
{
    public function index()
    {
        $allItems = DB::table('purchase_and_rentals')
            ->get();
        $userRentals = DB::table('user_rentals')
            ->join('users', 'users.id', 'user_rentals.user_id')
            ->join('purchase_and_rentals', 'purchase_and_rentals.id', 'user_rentals.rental_id')
            ->get();
        return view('features.purchaseandrental', [
            "items" => $allItems,
            'user_rentals' => $userRentals
        ]);
    }

    public function addPurchaseAndRental(Request $request)
    {
        if ($request->hasFile("item_image")) {
            $fileName = $request->file('item_image')->getClientOriginalName();
            $request->file('item_image')->move(public_path('img/purchaseandrentals/'), $fileName);
            // $request->file('item_image')->storeAs('public', $fileName);
            DB::table('purchase_and_rentals')
                ->insert([
                    'item_name' => $request->item_name,
                    'item_description' => $request->item_description,
                    'item_price' => $request->item_price,
                    'item_count' => $request->item_count,
                    'item_image' => $fileName,
                    'is_rental' => $request->is_rental,
                ]);
            return true;
        } else {
            return false;
        }
    }

    public function deletePurchaseAndRental(Request $request)
    {
        DB::table('purchase_and_rentals')
            ->where("id", $request->id)
            ->delete();
    }
}
