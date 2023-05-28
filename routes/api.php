<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Features\Mobile\BookNowController;
use App\Http\Controllers\Features\Mobile\RoomsAndCottagesController;
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

Route::post('mobileLogin', [LoginController::class, 'mobileLogin']);
Route::post('addBooking', [BookNowController::class, 'addbooking']);
Route::post('getUserBooking', [BookNowController::class, 'getUserBooking']);
Route::post('getIndividualBooking', [BookNowController::class, 'getIndividualBooking']);
Route::post('filterDates', [BookNowController::class, 'filterDates']);
Route::post('getFilteredRooms', [RoomsAndCottagesController::class, 'getFilteredRooms']);
Route::get('getAllRoomsAndCottages', [RoomsAndCottagesController::class, 'getAllRoomsAndCottages']);
