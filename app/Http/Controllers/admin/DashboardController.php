<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Rfids;
use App\Models\User;
use App\Models\Vehicles;
use App\Models\Blocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $accounts = User::join('accounts', 'accounts.user_id', '=', 'users.id')
            ->join('vehicles', 'vehicles.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email', 'accounts.balance', 'vehicles.regnum', 'vehicles.name as vname', 'vehicles.vclass')
            ->get();

            return view('admin.dashboard', [
                'accounts' => $accounts
            ]);
    }

    public function card($id)
    {
        $user = User::find($id);
        if(is_null($user)){
            return redirect()->back()->with('error', 'User deatails not found');
        }

        return view('admin.add-card', [
            'user' => $user
        ]);
    }

    public function add_card(Request $request)
    {
        $request->validate([
            'rfid' => 'required|numeric',
            'pin' => 'required|digits:4',
            'user_id' => 'required|numeric'
        ]);

        $card = Rfids::where('code', $request->rfid)->first();
        if(is_null($card)){
            $cad = Rfids::where('user_id', $request->user_id)->first();
            if(is_null($card)){
                $ca = new Rfids();
                $ca->user_id = $request->user_id;
                $ca->code = $request->rfid;
                $ca->pin = $request->pin;
                $ca->save();

                return redirect()->back()->with('success', 'Successfully added ID card to user');
            }else{
                return redirect()->back()->with('error', 'User already assigned a card!');
            }
        }

        return redirect()->back()->with('error', 'Cannot use this card');
    }

    public function add_exempt($user_id)
    {
        $veh = Vehicles::where('user_id', $user_id)->first();
        if(is_null($veh)){
            return redirect()->back()->with('error', 'Vehicle deatails not found');
        }

        $veh->vclass = 0;
        $veh->save();

        return redirect()->back()->with('success', 'Successfully Exempted vehicle');

    }

    public function remove_exempt($user_id)
    {
        $user = User::find($user_id);
        $veh = Vehicles::where('user_id', $user_id)->first();
        if(is_null($user)){
            return redirect()->back()->with('error', 'User deatails not found');
        }

        return view('admin.remove-exc', [
            'user' => $user,
            'veh' => $veh
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'vclass' => 'required|numeric'
        ]);

        $veh = Vehicles::where('user_id', $request->user_id)->first();
        if(is_null($veh)){
            return redirect()->back()->with('error', 'user not found!');
        }

        $veh->vclass = $request->vclass;
        $veh->save();

        return redirect()->back()->with('success', 'Successfully removed exemption');
    }

    public function block($user_id)
    {
        $card = Rfids::where('user_id', $user_id)->first();
        if(is_null($card)){
            return redirect()->back()->with('error', 'No card card found!');
        }
        $block = new Blocks();
        $block->rfid_id = $card->id;
        $block->status = "Blocked";
        $block->save();

        return redirect()->back()->with('success', 'Successfully blocked card');
    }

    public function unblock($user_id)
    {
        $card = Rfids::where('user_id', $user_id)->first();
        if(is_null($card)){
            return redirect()->back()->with('error', 'No card card found!');
        }

        $block = Blocks::where('rfid_id', $card->id)->first();
        $block->delete();

        return redirect()->back()->with('success', 'Successfully unblocked card');
    }
}
