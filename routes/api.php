<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Features\Mobile\BookNowController;
use App\Http\Controllers\Features\Mobile\PaymentController;
use App\Http\Controllers\Features\Mobile\RentalsController;
use App\Http\Controllers\Features\Mobile\RoomsAndCottagesController;
use App\Http\Controllers\Features\UserAccountsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();

Route::post('getProfile', [UserAccountsController::class, 'getProfile']);
Route::post('editProfile', [UserAccountsController::class, 'editProfile']);
Route::post('mobileLogin', [LoginController::class, 'mobileLogin']);


Route::post('addBooking', [BookNowController::class, 'addbooking']);
Route::post('cancelBooking', [BookNowController::class, 'cancelBooking']);
Route::post('getUserBooking', [BookNowController::class, 'getUserBooking']);
Route::post('getIndividualBooking', [BookNowController::class, 'getIndividualBooking']);
Route::post('filterDates', [BookNowController::class, 'filterDates']);
Route::post('getFilteredRooms', [RoomsAndCottagesController::class, 'getFilteredRooms']);
Route::get('getAllRoomsAndCottages', [RoomsAndCottagesController::class, 'getAllRoomsAndCottages']);

//payment
Route::post('submitPayment', [PaymentController::class, 'submitPayment']);

//rentals
Route::get('getAllRentals', [RentalsController::class, 'getAllRentals']);
Route::get('getNewestRental', [RentalsController::class, 'getNewestRental']);
Route::post('addPurchaseAndRentals', [RentalsController::class, 'addPurchaseAndRentals']);
Route::post('getUserPurchaseAndRentals', [RentalsController::class, 'getUserPurchaseAndRentals']);
Route::post('addPurchaseAndRentalsQuantity', [RentalsController::class, 'addPurchaseAndRentalsQuantity']);
Route::post('subtractPurchaseAndRentalsQuantity', [RentalsController::class, 'subtractPurchaseAndRentalsQuantity']);
Route::post('removePurchaseAndRentals', [RentalsController::class, 'removePurchaseAndRentals']);
Route::post('submitPurchaseAndRentalsPayment', [RentalsController::class, 'submitPurchaseAndRentalsPayment']);
