<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // memanggil relasi pake titik, transaction.user
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
        ->whereHas('product')->get();

        // memanggil relasi pake titik, transaction.user
        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
        ->whereHas('transaction')->get();

        return view('pages.admin.transaction.index',[
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }
    public function details()
    {
        return view('pages.dashboard-transactions-details');
    }
}
