<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function panel()
    {
        return view('user.panel');
    }

    public function listedAuctions()
    {
        $auctions = Auction::where('user_id', Auth::id())
            ->where('isSold', false)
            ->get();

        return view('user.auctions.listed', ['auctions' => $auctions]);
    }

    public function boughtAuctions()
    {
        $auctions = Auction::where('user_id', Auth::id())
            ->where('isSold', true)
            ->get();

        return view('user.auctions.bought', ['auctions' => $auctions]);
    }

    public function editAuction($id)
    {
        $auction = Auction::findOrFail($id);

        if ($auction->user_id !== auth()->user()->id) {
            return redirect()->route('user.auctions.listed')->with('error', 'You are not authorized to edit this auction.');
        }

        return view('user.auctions.edit', compact('auction'));
    }

    public function updateAuction(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);

        if ($auction->user_id !== auth()->user()->id) {
            return redirect()->route('user.auctions.listed')->with('error', 'You are not authorized to update this auction.');
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'condition' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'endDate' => 'required|date_format:Y-m-d\TH:i',
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $endDate = Carbon::parse($validatedData['endDate'])->format('Y-m-d H:i:s');

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

        return redirect()->route('user.auctions.listed')->with('success', 'Auction has been updated successfully.');
    }

    public function deleteAuction($id)
    {
        $auction = Auction::findOrFail($id);

        if ($auction->user_id !== auth()->user()->id) {
            return redirect()->route('user.auctions.listed')->with('error', 'You are not authorized to delete this auction.');
        }

        $auction->delete();

        return redirect()->route('user.auctions.listed')->with('success', 'Auction has been deleted successfully.');
    }

    public function showAddMoneyForm()
    {
        return view('user.addMoney');
    }

    public function addMoney(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        $user->money += $request->amount;
        $user->save();

        return redirect()->route('user.panel')->with('success', 'Money added successfully.');
    }
}