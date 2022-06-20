<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\TransactionDetail;
use App\Models\Transaction;


class DashboardController extends Controller
{
    public function index()
    {
        // memanggil relasi pake titik, transaction.user
        // get recent transaction
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product');
        // $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
        // ->whereHas('product', function ($product) {
        //     $product->where('users_id', Auth::user()->id);
        // });

        $customer = User::count();
        $revenue = Transaction::sum('total_price');// where('transaction_status' , 'SUCCESS') ->
        $transaction = Transaction::count();

        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction' => $transaction,
            'transaction_data' => $transactions
        ]);
    }
}
