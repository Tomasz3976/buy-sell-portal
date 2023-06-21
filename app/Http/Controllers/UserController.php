<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Facades\Auth;

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