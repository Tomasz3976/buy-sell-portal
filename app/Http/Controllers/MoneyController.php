<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    public function addMoney(Request $request)
    {
        return view('money.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
        ]);
    
        $user = auth()->user();
        $user->money += $validatedData['amount'];
        $user->save();

        return redirect()->back()->with('success', 'Money added successfully.');
    }
}
