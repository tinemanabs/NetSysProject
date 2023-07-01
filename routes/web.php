<?php

use App\Http\Controllers\Features\BookEventsController;
use App\Http\Controllers\Features\ProfileController;
use App\Http\Controllers\Features\UserAccountsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Features\BookNowController;
use App\Http\Controllers\Features\DashboardController;
use App\Http\Controllers\Features\PurchaseAndRental;
use App\Http\Controllers\Features\RoomsAndCottagesController;
use App\Http\Controllers\Features\SMSController;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    DB::table('web_visits')
        ->insert([
            'ip_address' => $request->ip()
        ]);
    $reviews = Reviews::all();
    return view('index', [
        'reviews' => $reviews
    ]);
});


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

// ADMIN / GUEST: PROFILE
Route::get('/editprofile/{id}', [ProfileController::class, 'index'])->name('editprofile');
Route::post('/editprofile', [ProfileController::class, 'updatePersonalInfo']);
Route::post('/editpassword', [ProfileController::class, 'updatePassword']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ADMIN: USER ACCOUNTS MODULE
Route::get('/useraccounts', [UserAccountsController::class, 'index'])->name('useraccounts');
Route::get('/addadmin', [UserAccountsController::class, 'showAddAdmin'])->name('showAddAdmin');
Route::post('/addadmin', [UserAccountsController::class, 'addAdmin']);

// ADMIN: ROOMS AND COTTAGES MODULE
Route::get('/rooms', [RoomsAndCottagesController::class, 'showRoomsPage'])->name('showRoomsPage');
Route::post('/addroom', [RoomsAndCottagesController::class, 'addRoom']);
Route::post('/deleteRoom/{id}', [RoomsAndCottagesController::class, 'deleteRoom']);
Route::get('/checkrooms', [RoomsAndCottagesController::class, 'checkRoomIndex'])->name('checkroom');
Route::get('/cottages', [RoomsAndCottagesController::class, 'showCottagesPage'])->name('showCottagesPage');
Route::post('/addcottage', [RoomsAndCottagesController::class, 'addCottage']);
Route::post('/deleteCottage/{id}', [RoomsAndCottagesController::class, 'deleteCottage']);
Route::get('/checkcottages', [RoomsAndCottagesController::class, 'checkCottageIndex'])->name('checkcottage');

// ADMIN / GUEST: BOOKING MODULE
Route::get('/booknow', [BookNowController::class, 'index'])->name('booknow');
Route::get('/addbooking', [BookNowController::class, 'addBooking'])->name('addbooking');
Route::get('/bookevent', [BookEventsController::class, 'index'])->name('bookevent');
Route::post('/admin-addbooking', [BookNowController::class, 'adminAddBooking']);
Route::post('/approvePaymentStatus/{id}', [BookNowController::class, 'approvePaymentStatus']);
Route::post('/checkFullPayment/{id}', [BookNowController::class, 'checkFullPayment']);
Route::post('/deleteBooking/{id}', [BookNowController::class, 'deleteBooking']);
Route::get('/viewBooking/{id}', [BookNowController::class, 'viewBooking'])->name('viewBooking');
Route::get('/getDisabledDates', [BookNowController::class, 'getDisabledDates']);
Route::get('/getFilteredRooms', [BookNowController::class, 'getFilteredRooms']);
Route::get('/getFilteredCottages', [BookNowController::class, 'getFilteredCottages']);
Route::get('/getUser/{id}', [BookNowController::class, 'getUserID']);
Route::get('/editBooking/{id}', [BookNowController::class, 'editBooking'])->name('editbooking');
Route::post('/admin-updatebooking/{id}', [BookNowController::class, 'updateBooking']);

// PURCHASE AND RENTAL MODULE
Route::get('/purchaseandrentals', [PurchaseAndRental::class, 'index'])->name('purchaseAndRentals');
Route::post('/addpurchaseandrental', [PurchaseAndRental::class, 'addPurchaseAndRental']);
Route::post('/deletepurchaseandrental', [PurchaseAndRental::class, 'deletePurchaseAndRental']);
Route::post('/returnPurchaseAndRental', [PurchaseAndRental::class, 'returnPurchaseAndRental']);
Route::post('/changeStocks', [PurchaseAndRental::class, 'changeStocks']);

//SMS Feature
Route::get('/smsDashboard', [SMSController::class, 'index'])->name('smsDashboard');
Route::get('/createSMS', [SMSController::class, 'createSMS'])->name('createsms');
Route::post('/sendSMS', [SMSController::class, 'itexmo'])->name('sendsms');
