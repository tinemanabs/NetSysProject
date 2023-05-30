<?php

use App\Http\Controllers\Features\BookEventsController;
use App\Http\Controllers\Features\ProfileController;
use App\Http\Controllers\Features\UserAccountsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Features\BookNowController;
use App\Http\Controllers\Features\PurchaseAndRental;
use App\Http\Controllers\Features\RoomsAndCottagesController;

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
Route::get('/cottages', [RoomsAndCottagesController::class, 'showCottagesPage'])->name('showCottagesPage');
Route::post('/addcottage', [RoomsAndCottagesController::class, 'addCottage']);

//Route::post('/addbooking', [BookNowController::class, 'addBooking']);

Route::get('/addbooking', [BookNowController::class, 'addBooking'])->name('addbooking');
Route::get('/bookevent', [BookEventsController::class, 'index'])->name('bookevent');
Route::post('/admin-addbooking', [BookNowController::class, 'adminAddBooking']);
Route::get('/getFilteredRooms/{place}', [BookNowController::class, 'getRooms']);
Route::get('/getFilteredCottages/{place}', [BookNowController::class, 'getCottages']);

Route::get('/purchaseandrentals', [PurchaseAndRental::class, 'index'])->name('purchaseAndRentals');
Route::post('/addpurchaseandrental', [PurchaseAndRental::class, 'addPurchaseAndRental']);
Route::post('/deletepurchaseandrental', [PurchaseAndRental::class, 'deletePurchaseAndRental']);
