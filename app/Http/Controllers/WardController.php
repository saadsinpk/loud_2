<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Lga;
use App\Models\Ward;
use Illuminate\Http\Request;
use App\Http\Requests\WardRequest;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wards = Ward::with("lga")->orderBy("created_at", "DESC")->get();
        $lgas = Lga::orderBy("created_at", "DESC")->get();

        if (request()->ajax()) {
            return DataTables::of($wards)
            ->addColumn('group', function ($data) {
                return '';
            })
            ->addColumn('checkbox', function ($data) {
                $checkbox = '<div class="d-none">
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
              
                $action .= '<a class="btn btn-xs btn-success col-3 mr-2" href="'.url("/wards/view/$data->id").'"><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs btn-danger col-3 mr-2" href="#" data-kt-table-filter="delete_row"><i class="fas fa-trash"></i></a>';

                return $action;
            })

            ->rawColumns(['checkbox', 'group', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("ward.index", compact("wards","lgas"));
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
        $lga_id = $request->lga_id;

        $wards = Ward::select("id" , "name as text")
        ->where('lga_id',$lga_id)
        ->where('name', 'like', '%' .$search . '%')
        ->orderBy("created_at", "DESC")
        ->get();
        return response()->json($wards);
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
            'name' => 'required',
            'lga_id' => 'required'
        ]);
        $data = $request->only(['name' , 'lga_id']);
        $item = Ward::create($data);
        return response()->json(['msg'=>"Ward created successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id) {

        $ward = Ward::find($id);
        $lgas = Lga::orderBy("created_at", "DESC")->get();
        $ward_logs = $ward->lga()->pluck('id')->toArray(); 
        return view("ward.details", compact('ward','lgas','ward_logs'));
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
            'name' => 'required',
            'lga_id' => 'required'
        ]);
        $data = $request->only(['name', 'lga_id']);
        $item = Ward::find($request->id);
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
        $item = Ward::find($id);
        $item->delete();
        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        Ward::whereIn("id", explode(",", $request->ids))->delete();
        return response()->json('200');
    }
}
