<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Rfids;
use App\Models\Tolfees;
use App\Models\Transactions;
use App\Models\Phones;
use App\Models\Vehicles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Twilio\Rest\Client;
use Mail;

class RFIDController extends Controller
{
    public function scan(Request $request)
    {
        return view('scan');
    }

    public function scanner(Request $request)
    {
        $rfid = Rfids::where('code', $request->rfid)->first();

        if(is_null($rfid)){
            return redirect()->back()->with('error', 'ID not registered, please try again!');
        }

        $account = User::join('accounts', 'accounts.user_id', '=', 'users.id')
            ->join('vehicles', 'vehicles.user_id', '=', 'users.id')
            ->where('users.id', $rfid->user_id)
            ->select('users.id', 'users.name', 'users.email', 'accounts.balance', 'vehicles.regnum', 'vehicles.name as vname', 'vehicles.vclass')
            ->first();

        if(is_null($account)){
            return redirect()->back()->with('error', 'No account matching ID card, please try again!');
        }

        $fee = Tolfees::where('class', $account->vclass)->first();
        if(is_null($fee)){
            return redirect()->back()->with('error', 'No tol fee detected, please try again!');
        }


        if($account->balance < $fee->amount){
            return redirect()->route('scan')->with('error', 'You have insuffient funds in your card!');
        }

        $trans = new Transactions();
        $trans->user_id = $account->id;
        $trans->action = "tolgate";
        $trans->reference = "tol".now();
        $trans->amount =$fee->amount;
        $trans->status = "successful";
        $trans->balance = $account->balance - $fee->amount;
        $trans->save();

        $acc = Accounts::where('user_id', $account->id)->first();
        $acc->balance = $acc->balance - $fee->amount;
        $acc->save();

        /* 
            SMS
        */

        $veh = Vehicles::where('user_id', $account->id)->first();
        
        //$receiverNumber = $phone->number;
        $message = "You have successfully paid tolgate amount $".$fee->amount." for vehicle identified as ".$veh->name." reg number: ".$veh->regnum." at ".now();

        $details = [

            'title' => 'Mail From Tolgate App',
    
            'body' => $message
    
        ];
        \Mail::to($account->email)->send(new \App\Mail\MyTestMail($details));

        return redirect()->back()->with('success', 'Successfully paid tolgate fees');
        
    }

    public function pin(Request $request)
    {
        $request->validate([
            'pin' => 'required|numeric',
            'amount' => 'required|numeric',
            'balance' => 'required|numeric',
            'user_id' => 'required|numeric'
        ]);

        $card = Rfids::where('user_id', $request->user_id)->where('pin', $request->pin)->first();
        if(is_null($card)){
            return redirect()->route('scan')->with('error', 'Invalid pin please try again!');
        }

        if($request->balance < $request->amount){
            return redirect()->route('scan')->with('error', 'You have insuffient funds in your card!');
        }

        $trans = new Transactions();
        $trans->user_id = $request->user_id;
        $trans->action = "tolgate";
        $trans->amount =$request->amount;
        $trans->status = "successful";
        $trans->balance = $request->balance - $request->amount;
        $trans->save();

        $acc = Accounts::where('user_id', $request->user_id)->first();
        $acc->balance = $acc->balance - $request->amount;
        $acc->save();

        return redirect()->route('scan')->with('success', 'Successfully paid tolgate fees');
    }
}


