<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = request()->query('id');
        $foundProduct = Product::where('id', $data)->first();

        // check if product with this id related to user transaction relation
        $transactions = TransactionDetail::where('products_id', $data)->whereHas('transaction', function ($transaction) {
            $transaction->where('users_id', Auth::user()->id);
        })->first();

        if($transactions){
            return view('pages.comment-create', ['datas' => $foundProduct]);

        }

        return redirect()->back()->with('error', 'You can\'t comment this product');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;

        try {
            Comment::create($data);
            return redirect()->route('dashboard-transaction-details-buy', $data['products_id']);
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
