<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Accounts;
use App\Models\Paynowlogs;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class AccountController extends Controller
{
    public function deposit(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'phone' => 'required|digits:10|starts_with:07',
            'amount' => 'required|numeric'
        ]);

        $wallet = "ecocash";

        //get all data ready
        $email = $fields['email'];
        $phone = $fields['phone'];
        $amount = $fields['amount'];

        //account
        $account = Accounts::where('user_id', Auth::id())->first();

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('user-deposit-post'),
            route('user-deposit-post'),
        );

        // Create Payments
        $invoice_name = "tolgate_deposit_" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("Tolgate Deposit", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);


        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlogs();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //transaction update
                    $trans = new Transactions();
                    $trans->user_id = Auth::id();
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "deposit";
                    $trans->amount = $info['amount'];
                    $trans->status = "successful";
                    $trans->balance = $account->balance + $info['amount'];
                    $trans->save();

                    $account->balance = $account->balance + $info['amount'];
                    $account->save();

                    return redirect()->back()->with('success', 'Succesfully deposited money');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlogs();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();


                    //transaction update
                    $trans = new Transactions();
                    $trans->user_id = Auth::id();
                    $trans->reference = $info['paynowreference'];
                    $trans->action = "deposit";
                    $trans->amount = $info['amount'];
                    $trans->status = $info['status'];
                    $trans->balance = $account->balance;
                    $trans->save();

                    return redirect()->back()->with('error', 'Taking too long wait and refresh');
                } //endif
            } //endwhile
        } //endif


        //total fail
        return redirect()->back()->with('error', 'Cannot perform transaction at the moment');

    }

    public function transactions()
    {
        $transactions = Transactions::where('user_id', Auth::id())->get();

        return view('user.transactions',[
            'transactions' => $transactions
        ]);
    }

    public function report()
    {
        $transactions = Transactions::where('user_id', Auth::id())->get();

        $pdf = PDF::loadView('user.pdf.transactions', [
            'transactions' => $transactions
        ]);
        return $pdf->download(now().'admin-transaction.pdf');
    }

    public function deposit_index()
    {
        return view('user.deposit');
    }
}
