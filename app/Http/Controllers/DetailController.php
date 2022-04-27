<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;
use Exception;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user', 'review'])->where('slug', $id)->firstOrFail();
        $wishlist = Wishlist::where('products_id', $product->id)->where('users_id', Auth::user()->id)->first();
        
        return view('pages.detail', [
            'product' => $product,
            'wishlist' => $wishlist
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
