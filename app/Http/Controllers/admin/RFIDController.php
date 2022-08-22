<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Rfids;
use App\Models\Tolfees;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        //dd($rfid);

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


        return view('pin',[
            'account' => $account,
            'fee' => $fee
        ]);
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


