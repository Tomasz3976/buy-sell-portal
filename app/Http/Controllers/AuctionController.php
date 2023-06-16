<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('uploads', 'public');
            $auction->photo = $photoPath;
        }

        $auction->save();

        return redirect()->route('auctions.index')->with('success', 'Auction created successfully.');
    }
}
