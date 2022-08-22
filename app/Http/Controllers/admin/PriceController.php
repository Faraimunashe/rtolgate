<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tolfees;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $prices = Tolfees::all();

        return view('admin.prices', [
            'prices' => $prices
        ]);
    }

    public function price($id)
    {
        $price = Tolfees::find($id);

        return view('admin.update-price', [
            'price' => $price
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'price_id' => 'required|numeric',
            'class' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        $price = Tolfees::find($request->price_id);
        if(is_null($price)){
            return redirect()->back()->with('error', 'Tolfee could not be found');
        }

        $price->amount = $request->amount;
        $price->save();

        return redirect()->route('admin-prices')->with('success', 'Success updated tolfee');
    }
}
