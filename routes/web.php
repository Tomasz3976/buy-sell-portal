<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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
    Route::get('/user/auctions/{id}/edit', [UserController::class, 'editAuction'])->name('user.auctions.edit');
    Route::put('/user/auctions/{id}', [UserController::class, 'updateAuction'])->name('user.auctions.update');
    Route::get('/user/auctions/bought', [UserController::class, 'boughtAuctions'])->name('user.auctions.bought');
    Route::delete('user/auctions/{id}', [UserController::class, 'deleteAuction'])->name('user.auctions.delete');
    Route::get('/user/addMoney', [UserController::class, 'showAddMoneyForm'])->name('user.showAddMoneyForm');
    Route::post('/user/addMoney', [UserController::class, 'addMoney'])->name('user.processAddMoney');

    Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
    Route::get('/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
    Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');
    Route::get('/auctions/buy/{id}', [AuctionController::class, 'buy'])->name('auctions.buy');
    Route::post('/auctions/{id}/confirm-buy', [AuctionController::class, 'confirmBuy'])->name('auctions.confirmBuy');
    
});

Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/auctions', [AdminController::class, 'index'])->name('admin.auctions.index');
    Route::get('/auctions/{id}/edit', [AdminController::class, 'edit'])->name('admin.auctions.edit');
    Route::put('/auctions/{id}', [AdminController::class, 'update'])->name('admin.auctions.update');
    Route::delete('/auctions/{id}', [AdminController::class, 'delete'])->name('admin.auctions.delete');
});
