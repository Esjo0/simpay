<?php

use Illuminate\Support\Facades\Route;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $status = [
        1 => 'Initiated',
        2 => 'Pending',
        3 => 'Completed',
        4 => 'Declined'
    ];
    $transactions = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
    return view('dashboard', compact('transactions', 'status'));
})->middleware(['auth'])->name('dashboard');

Route::post('/makepayment', [App\Http\Controllers\TransactionController::class, 'prepareTransaction'])->middleware(['auth'])->name('make.payment');
Route::get('/verifypayment/{encrypted_trans_id}', [App\Http\Controllers\TransactionController::class, 'verifyTransaction'])->middleware(['auth'])->name('verify.payment');


require __DIR__.'/auth.php';
