<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchProductController extends Controller
{
    //

    public function search(Request $request)
    {   
        if(!$request->search){
            // return back with error
            return redirect()->back()->withErrors(['error' => 'Please enter a search term']);
        }

        $dataToSearch = Product::whereFuzzy('name', $request->search)->get();
        return view('pages.search', [
            'dataToSearch' => $dataToSearch
        ]);
    }
}
