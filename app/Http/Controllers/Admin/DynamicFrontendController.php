<?php

namespace App\Http\Controllers\Admin;

use App\Models\DynamicFrotend;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DynamicFrontendController extends Controller
{
    // get request from FE and save the photo array max 3 to storage
    public function store(Request $request){
        try{
            if($request->hasFile('photos')){
                if(DynamicFrotend::all()->count() < 3){
                    $photos = $request->file('photos');
                    foreach($photos as $photo){
                        $photo->store('assets/dynamicfes', 'public');
                    }
                    return redirect()->route('home');
                } else {
                    $photos = $request->file('photos');
                    DynamicFrotend::all()->delete();
                    foreach($photos as $photo){
                        $photo->store('assets/dynamicfes', 'public');
                    }
                    return redirect()->route('home');
                }
            }
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function index(){
        $photos = DynamicFrotend::all();
        return view('pages.admin.dynamicfes.index', [
            'photos' => $photos
        ]);
    }
}
