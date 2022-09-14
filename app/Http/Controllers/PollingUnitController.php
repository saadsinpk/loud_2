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
        $lgas = Lga::orderBy("created_at", "DESC")->get();
        $wards = Ward::orderBy("created_at", "DESC")->get();

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
                $action .= 
                    '<a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-action" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                            </svg>
                        </span>
                    </a>';
                    
                $action .=  
                '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">';
                

                $action .= '<div class="menu-item px-3">
                                <a href="'.url("/pollingunits/view/$data->id").'" class="menu-link px-3">Edit</a>
                            </div>';


                $action .= '<div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-table-filter="delete_row">Delete</a>
                             </div>';


                $action .= "</div>";

                return $action;
            })

            ->rawColumns(['checkbox', 'group', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("pollingunits.index", compact("pollingunits","wards","lgas"));
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
