<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Facades\Validator;

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

        // Walidacja pól
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'condition' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'endDate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Aktualizacja aukcji
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
