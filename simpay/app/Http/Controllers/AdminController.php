<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaction;

class AdminController extends Controller
{
    //
    public function index(){
            return view('admin');
    }

    public function allTransactions(Request $request){
        if($request->access_code == '55667788'){
            $status = [
                1 => 'Initiated',
                2 => 'Pending',
                3 => 'Completed',
                4 => 'Declined'
            ];
            $transactions = Transaction::whereNotNull('id')->orderBy('created_at', 'desc')->get();
            
            return view('transactions', compact('transactions', 'status'));
        }else{
            return redirect()->route('admin')->with('error', 'Access Denied');
        }
        
    }
}
