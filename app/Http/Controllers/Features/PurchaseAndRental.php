<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseAndRental extends Controller
{
    public function index()
    {
        $allItems = DB::table('purchase_and_rentals')
            ->get();
        return view('features.purchaseandrental', [
            "items" => $allItems,
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
