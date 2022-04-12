<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // make comment
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            Review::create([
                'products_id' => $data['products_id'],
                'users_id' => Auth::user()->id,
                'description' => $data['description'],
            ]);
            return redirect()->route('product.detail', $data['products_id']);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
