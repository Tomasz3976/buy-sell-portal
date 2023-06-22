<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;

class AdminController extends Controller
{
    public function index()
    {
        $auctions = Auction::all();
        return view('admin.auctions.index', compact('auctions'));
    }

    public function edit($id)
    {
        $auction = Auction::findOrFail($id);
        return view('admin.auctions.edit', compact('auction'));
    }

    public function update(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);
        $auction->update($request->all());

        return redirect()->route('admin.auctions.index')->with('success', 'Auction updated successfully');
    }

    public function delete($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->delete();

        return redirect()->route('admin.auctions.index')->with('success', 'Auction deleted successfully');
    }
}
