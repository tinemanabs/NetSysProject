<?php

use App\Http\Controllers\Features\BookEventsController;
use App\Http\Controllers\Features\ProfileController;
use App\Http\Controllers\Features\UserAccountsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Features\BookNowController;
use App\Http\Controllers\Features\PurchaseAndRental;
use App\Http\Controllers\Features\RoomsAndCottagesController;
use App\Http\Controllers\Features\SMSController;

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

Route::get('/', function () {
    return view('index');
});


Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/booknow', [BookNowController::class, 'index'])->name('booknow');
Route::get('/editprofile/{id}', [ProfileController::class, 'index'])->name('editprofile');
Route::post('/editprofile', [ProfileController::class, 'updatePersonalInfo']);
Route::post('/editpassword', [ProfileController::class, 'updatePassword']);

// ADMIN 
Route::get('/useraccounts', [UserAccountsController::class, 'index'])->name('useraccounts');
Route::get('/addadmin', [UserAccountsController::class, 'showAddAdmin'])->name('showAddAdmin');
Route::post('/addadmin', [UserAccountsController::class, 'addAdmin']);
Route::get('/rooms', [RoomsAndCottagesController::class, 'showRoomsPage'])->name('showRoomsPage');
Route::post('/addroom', [RoomsAndCottagesController::class, 'addRoom']);
Route::post('/deleteRoom/{id}', [RoomsAndCottagesController::class, 'deleteRoom']);
Route::get('/cottages', [RoomsAndCottagesController::class, 'showCottagesPage'])->name('showCottagesPage');
Route::post('/addcottage', [RoomsAndCottagesController::class, 'addCottage']);
Route::post('/deleteCottage/{id}', [RoomsAndCottagesController::class, 'deleteCottage']);


//Route::post('/addbooking', [BookNowController::class, 'addBooking']);

Route::get('/addbooking', [BookNowController::class, 'addBooking'])->name('addbooking');
Route::get('/bookevent', [BookEventsController::class, 'index'])->name('bookevent');
Route::post('/admin-addbooking', [BookNowController::class, 'adminAddBooking']);
Route::get('/getFilteredRooms/{place}', [BookNowController::class, 'getRooms']);
Route::get('/getFilteredCottages/{place}', [BookNowController::class, 'getCottages']);
Route::post('/approvePaymentStatus/{id}', [BookNowController::class, 'approvePaymentStatus']);
Route::post('/checkFullPayment/{id}', [BookNowController::class, 'checkFullPayment']);
Route::post('/deleteBooking/{id}', [BookNowController::class, 'deleteBooking']);

Route::get('/purchaseandrentals', [PurchaseAndRental::class, 'index'])->name('purchaseAndRentals');
Route::post('/addpurchaseandrental', [PurchaseAndRental::class, 'addPurchaseAndRental']);
Route::post('/deletepurchaseandrental', [PurchaseAndRental::class, 'deletePurchaseAndRental']);

//SMS Feature
Route::get('/smsDashboard', [SMSController::class, 'index'])->name('smsDashboard');
Route::get('/createSMS', [SMSController::class, 'createSMS'])->name('createsms');
Route::post('/sendSMS', [SMSController::class, 'itexmo'])->name('sendsms');
