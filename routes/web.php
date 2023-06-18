<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuctionController;

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

Auth::routes();

Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');
Route::get('/auctions/create', [AuctionController::class, 'create'])->name('auctions.create');
Route::post('/auctions', [AuctionController::class, 'store'])->name('auctions.store');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
