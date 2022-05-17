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
            if($request->hasFile('photos'))
            {
                $photos = $request->file('photos');
                foreach ( $photos as $photo ) {
                    $dataToStore = $photo->store('assets/dynamicfes', 'public');
                    array_push($this->dataPhoto, $dataToStore);
                }
            }

            if(isset($this->dataPhoto)){
                foreach($this->dataPhoto as $data){
                    $dataToUpload = [
                        'photos' => $data
                    ];
                    DynamicFrontend::create($dataToUpload);
                }
                unset($this->dataPhoto);
                return redirect()->route('dynamicfe.index');
            }
            unset($this->dataPhoto);
            return redirect()->route('dynamicfe.index');

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
                    if($item->status == 1){
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
                                        <form action ="' . route('dynamicfe.update', $item->id) . '" method="POST">
                                        ' . method_field('put') . csrf_field() . '

                                            <button type="submit" class="dropdown-item">
                                                Non Aktifkan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ';
                    } else {
                        return '
                                <div class="btn-group>
                                    <div class="dropdown>
                                        <button class ="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu">
                                            <form action ="' . route('dynamicfe.destroy', $item->id) . '" method="POST">
                                            ' . method_field('delete') . csrf_field() . '
                                                <input name="active" value="0" hidden/>
                                                <button type="submit" class="dropdown-item text-danger">
                                                    Hapus
                                                </button>
                                            </form>
                                            <form action ="' . route('dynamicfe.update', $item->id) . '" method="POST">
                                            ' . method_field('put') . csrf_field() . '
                                                <input name="active" value="1" hidden/>
                                                <button type="submit" class="dropdown-item">
                                                    Aktifkan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                })
                ->addColumn('photos', function($item) {
                return $item->photos ? '<img src="' . Storage::url($item->photos) . '" style="max-height: 40px;" />' : '';
                })
                ->addColumn('created_at', function($item){
                    return $item->created_at ? $item->created_at->format('d-m-Y H:i:s') : '';
                })
                ->rawColumns(['action', 'photos'])
                ->make();
        }
        return view('pages.admin.dynamicfes.index');
    }

    public function create()
    {
        return view('pages.admin.dynamicfes.create');
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

    public function update(Request $request, $id)
    {
        try{
            $data = (int) $request->active;
            DynamicFrontend::where('id', $id)->update(['status' => $data ]);
            return redirect()->route('admin.dynamicfes');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
