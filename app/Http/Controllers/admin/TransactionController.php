<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;
use PDF;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transactions::all();

        return view('admin.transactions', [
            'transactions' => $transactions
        ]);
    }

    public function report()
    {
        $transactions = Transactions::all();

        $pdf = PDF::loadView('admin.pdf.transactions', [
            'transactions' => $transactions
        ]);
        return $pdf->download(now().'admin-transaction.pdf');
    }
}
