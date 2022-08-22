<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Rfids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function index()
    {
        $card = Rfids::where('user_id', Auth::id())->first();
        if(is_null($card)){
            return redirect()->back()->with('error', 'You have no valid ID card visit admin!');
        }
        return view('user.change-pin');
    }

    public function change(Request $request)
    {
        $request->validate([
            'old_pin' => 'required|digits:4',
            'new_pin' => 'required|digits:4',
            'new_pin_again' => 'required|digits:4'
        ]);

        if($request->new_pin != $request->new_pin_again){
            return redirect()->back()->with('error', 'Pin Confirmation must match');
        }

        if($request->old_pin == $request->new_pin){
            return redirect()->back()->with('error', 'Please enter a new pin');
        }

        $card = Rfids::where('user_id', Auth::id())->where('pin', $request->old_pin)->first();
        if(is_null($card)){
            return redirect()->back()->with('error', 'Invalid pin try again!');
        }

        $card->pin = $request->new_pin;
        $card->save();

        return redirect()->back()->with('success', 'successfully changed card pin');
    }
}
