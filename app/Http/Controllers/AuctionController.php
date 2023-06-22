<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Auction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::all();
        
        return view('auctions.index', compact('auctions'));
    }

    public function create()
    {
        return view('auctions.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'condition' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'endDate' => 'required|date_format:Y-m-d\TH:i',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $endDate = Carbon::parse($validatedData['endDate'])->format('Y-m-d H:i:s');

        $auction = new Auction();
        $auction->name = $validatedData['name'];
        $auction->condition = $validatedData['condition'];
        $auction->category = $validatedData['category'];
        $auction->price = $validatedData['price'];
        $auction->endDate = $endDate;
        $auction->user_id = Auth::id();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads', 'public');
            $auction->photo = $photoPath;
        }

        $auction->save();

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully.');
    }

    public function buy($id)
    {
        $auction = Auction::findOrFail($id);

        return view('auctions.buy', compact('auction'));
    }

    public function confirmBuy($id)
    {
        $auction = Auction::findOrFail($id);

        if ($auction->isSold) {
            return redirect()->back()->with('error', 'This auction has already been sold.');
        }

        $endDate = Carbon::parse($auction->endDate);
        if (Carbon::now()->gt($endDate)) {
            return redirect()->back()->with('error', 'This auction has already ended.');
        }

        $user = auth()->user();
        if ($user->money < $auction->price) {
            return redirect()->back()->with('error', 'You do not have enough money to purchase this auction.');
        }

        if ($auction->user_id == $user->id) {
            return redirect()->back()->with('error', 'You cannot purchase your own auction.');
        }

        $user->money -= $auction->price;
        $user->save();

        $seller = $auction->user;
        $seller->money += $auction->price;
        $seller->save();

        $auction->isSold = true;
        $auction->user_id = $user->id;
        $auction->save();

        return redirect()->route('auctions.index')->with('success', 'Auction purchased successfully.');
    }
}
