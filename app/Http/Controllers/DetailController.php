<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\User;
use App\Models\Wishlist;
use Exception;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    private $dataComment = array();
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user'])->where('slug', $id)->firstOrFail();
        $comment = Comment::with(['user'])->where('products_id', $product->id)->get();

        foreach ($comment as $comm){

            $commentToReturn = [
                'description' => $comm->description,
                'user_id' => $comm->users_id,
                'user' => User::where('id', $comm->users_id)->first(),
            ];
            array_push($this->dataComment, $commentToReturn);
        }

        if(Auth::user()){
            $wishlist = Wishlist::where('products_id', $product->id)->where('users_id', Auth::user()->id)->first();
            return view('pages.detail', [
                'product' => $product,
                'wishlist' => $wishlist,
                'comment' => $this->dataComment,
            ]);
        }

        return view('pages.detail', [
            'product' => $product,
            'comment' => $this->dataComment,
        ]);
    }

    public function add(Request $request, $id)
    {
        try{
            $data = [
                'products_id' => $id,
                'users_id' => Auth::user()->id,
            ];

            // check if data exist in wishlist
            $wishlist = Wishlist::where('products_id', $id)->where('users_id', Auth::user()->id)->first();
            if ($wishlist) {
                // delete wishlist tersebut dan masukkan ke cart
                Cart::create($data);
                $wishlist->delete();
                return redirect()->route('cart');
            } else {
                Cart::create($data);
                return redirect()->route('cart');
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        
    }
}
