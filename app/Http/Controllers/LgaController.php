<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Lga;
use Illuminate\Http\Request;
use App\Http\Requests\LgaRequest;
//use Illuminate\Support\Facades\Validator;

class LgaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lgas = Lga::orderBy("created_at", "DESC")->get();
        if (request()->ajax()) {
            return DataTables::of($lgas)
            ->addColumn('group', function ($data) {
                return '';
            })
            ->addColumn('checkbox', function ($data) {
                $checkbox = '<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" value="1" />
                                <input type="hidden" value="'.$data->id.'">
                            </div>';
                return $checkbox;
            })
            ->addColumn('created_at', function ($row) { 
                $create_date = "<span style='display:none;'>".$row->created_at->timestamp."</span>".e($row->created_at->format('d M Y, g:i A'));
                return $create_date;
            })             
            ->addColumn('action', function ($data) {
                $action = '';   
                $action .= '<a class="btn btn-info btn-sm" href="'.url("/lgas/view/$data->id").'">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>';


                $action .= '<a class="btn btn-danger btn-sm" href="#" data-kt-table-filter="delete_row">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>';

                return $action;
            })

            ->rawColumns(['checkbox', 'group', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("lga.index", compact("lgas"));
    }

    /**
     * getList return all avilable ward to use it in dropdown select2 ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        $search = $request->search;
        $lgas = Lga::select("id" , "name as text")
        ->where('name', 'like', '%' .$search . '%')
        ->orderBy("created_at", "DESC")
        ->get();
        return response()->json($lgas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $data = $request->only(['name']);
        $item = Lga::create($data);
        return response()->json(['msg'=>"LGA created successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id) {

        $lga = Lga::find($id);
        return view("lga.details", compact('lga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $data = $request->only(['name']);
        $item = Lga::find($request->id);
        $item->fill($data);
        $item->save();
        
        if (!$item->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        };

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Lga::find($id);
        if($item){
            $item->wards()->delete();
            $item->delete();
            return response()->json('200');
        }
    }

    public function destroyRows(Request $request) {
        Lga::whereIn("id", explode(",", $request->ids))->delete();
        return response()->json('200');
    }
}
