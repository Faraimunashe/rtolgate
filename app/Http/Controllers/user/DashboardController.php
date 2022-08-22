<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Rfids;
use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $vehicle = Vehicles::where('user_id', Auth::id())->first();
        $account = Accounts::where('user_id', Auth::id())->first();
        $card = Rfids::where('user_id', Auth::id())->first();

        return view('user.dashboard', [
            'vehicle' => $vehicle,
            'account' => $account,
            'card' => $card
        ]);
    }
}
