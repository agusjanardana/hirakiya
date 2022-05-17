<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchProductController extends Controller
{
    //

    public function search(Request $request)
    {
        $dataToSearch = Product::whereFuzzy('name', $request->search)->get();
        return view('pages.search', [
            'dataToSearch' => $dataToSearch
        ]);
    }
}
