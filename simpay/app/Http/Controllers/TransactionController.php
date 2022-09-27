<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\transaction;
use App\Paystack;

class TransactionController extends Controller
{
    //
    public function prepareTransaction(Request $request){
        
        // $request->validate([
        //     'amount' => ['required', 'integer', 'max:255'],
        //   ]);
        $amount = $request->amount;
        $transaction_id = 'SP'.time();
        //Save Transaction
        Transaction::create([
            'user_id' => Auth::user()->id,
            'transaction_id' => $transaction_id,
            'amount' => $amount,
            'status' => '1'
        ]);

        $body = [
            "email" => Auth::user()->email,
            "amount" => $amount,
            "currency" => 'NGN',
            "transaction_id" => $transaction_id,
            "redirect_url" => route('verify.payment', ['encrypted_trans_id' => encrypt($transaction_id)]),
        ];
        $paystack = new Paystack();
        return $paystack->initialize($body);

    }

    public function verifyTransaction($encrypted_trans_id)
    {
        if (Transaction::where('transaction_id', decrypt($encrypted_trans_id))->first()) {
            $paystack = new Paystack();
            $verify =  $paystack->verify_transaction();

            if($verify['status'] == 'true'){
                Transaction::where('transaction_id', decrypt($encrypted_trans_id))
                ->update(['status' => '3']);
                return redirect()->route('dashboard')->with('success', 'Transaction successful');
            }else{
                Transaction::where('transaction_id', decrypt($encrypted_trans_id))
                ->update(['status' => '4']);
                return redirect()->route('dashboard')->with('error', 'Transaction Not successful try again');
            }
        } else {
            return redirect()->route('dashboard')->with('error', 'Transaction does not exisit');
        }
    }
}
