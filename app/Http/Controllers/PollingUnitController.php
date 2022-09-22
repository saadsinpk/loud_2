<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Lga;
use App\Models\Ward;
use App\Models\PollingUnit;
use Illuminate\Http\Request;
use App\Http\Requests\PollingUnitRequest;

class PollingUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pollingunits = PollingUnit::with(["lga","ward"])->orderBy("created_at", "DESC")->get();
        
        if (request()->ajax()) {
            return DataTables::of($pollingunits)
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

                $action .= '<a class="btn btn-xs btn-success col-3 mr-2" href="'.url("/pollingunits/view/$data->id").'"><i class="fas fa-pencil-alt"></i></a>';


                $action .= '<a class="btn btn-xs btn-danger col-3 mr-2" href="#" data-kt-table-filter="delete_row"><i class="fas fa-trash"></i></a>';

                return $action;
            })

            ->rawColumns(['checkbox', 'group', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("pollingunits.index", compact("pollingunits"));
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
        $wards_id = $request->wards_id;

        $pus = PollingUnit::select("id" , "name as text")
        ->where('lga_id',$lga_id)
        ->where('wards_id',$wards_id)
        ->where('name', 'like', '%' .$search . '%')
        ->orderBy("created_at", "DESC")
        ->get();
        return response()->json($pus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PollingUnitRequest $request)
    {
        $data = $request->only(['name' , 'lga_id' , 'wards_id']);
        $item = PollingUnit::create($data);
        return response()->json(['msg'=>"Polling Unit created successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id) {
        $pollingunit = PollingUnit::find($id);
       // $lgas = Lga::orderBy("created_at", "DESC")->get();
        $pu_ward_ids = $pollingunit->ward()->pluck('id')->toArray(); 
        $pu_lga_ids = $pollingunit->lga()->pluck('id')->toArray(); 
        return view("pollingunits.details", compact('pollingunit','pu_ward_ids','pu_lga_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PollingUnitRequest $request)
    {
        $data = $request->only(['name', 'lga_id' , 'wards_id']);
        $item = PollingUnit::find($request->id);
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
        // must check if used in Political Party Agent so can't remove it
        $item = PollingUnit::find($id);
        $item->delete();
        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        PollingUnit::whereIn("id", explode(",", $request->ids))->delete();
        return response()->json('200');
    }

}
