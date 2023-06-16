<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::all();
        
        return view('auctions.index', compact('auctions'));
    }
}
