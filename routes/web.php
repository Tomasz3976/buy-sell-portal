<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\MoneyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes([
    'login' => true,
    'logout' => true,
    'register' => true,
    'reset' => false,
]);


Route::group(['middleware' => 'auth.user'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/user/panel', [UserController::class, 'panel'])->name('user.panel');
    Route::get('/user/auctions/listed', [UserController::class, 'listedAuctions'])->name('user.auctions.listed');
    Route::delete('user/auctions/{id}', [UserController::class, 'destroyAuction'])->name('user.auctions.destroy');
    Route::get('/user/auctions/bought', [UserController::class, 'boughtAuctions'])->name('user.auctions.bought');
    Route::get('/user/addMoney', [UserController::class, 'showAddMoneyForm'])->name('user.showAddMoneyForm');
    Route::post('/user/addMoney', [UserController::class, 'addMoney'])->name('user.processAddMoney');

    Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
    Route::get('/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
    Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');
    
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {

});
