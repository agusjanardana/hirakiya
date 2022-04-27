<?php

namespace App\Http\Controllers\Admin;

use App\Models\DynamicFrontend;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DynamicFrontendController extends Controller
{
    private $dataPhoto = array();
    // get request from FE and save the photo array max 3 to storage
    public function store(Request $request){
        try{
            if($request->hasFile('photos')){
                if(DynamicFrontend::all()->count() <= 3){
                    $photos = $request->file('photos');
                    foreach($photos as $photo){
                        $photo->store('assets/dynamicfes', 'public');
                        array_push($this->dataPhoto, $photo);
                    }
                } else {
                    $photos = $request->file('photos');
                    foreach($photos as $photo){
                        $photo->store('assets/dynamicfes', 'public');
                        array_push($this->dataPhoto, $photo);
                    }
                }
            }

            if(isset($this->dataPhoto)){
                foreach($this->dataPhoto as $data){
                    DynamicFrontend::create('photos', $this->$data);
                }
                unset($this->dataPhoto);
                return redirect()->route('home');
            }
            unset($this->dataPhoto);
            return redirect()->route('home');

        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function index(){
        if (request()->ajax()) {
            // get all data from dynamicfrontend
            $data = DynamicFrontend::query();
            return DataTables::of($data)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group>
                            <div class="dropdown>
                                <button class ="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <form action ="' . route('dynamicfe.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '

                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('photos', function($item) {
                    return '
                    <div>
                        <img src="'. $item->photos ? Storage::url($item->photos) : "no image"  .'"/>
                    </div>
                    ';
                })
                ->rawColumns(['action', 'photos'])
                ->make();
        }
        return view('pages.admin.dynamicfes.index');
    }

    public function destroy($id)
    {
        try{
            DynamicFrontend::where('id', $id)->delete();
            return redirect()->route('admin.dynamicfes');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
