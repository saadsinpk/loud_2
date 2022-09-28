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
    public function index(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $searchword = $request->input('searchword');
        $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
        $limit = (int)$length > 0 ? $length : 10;
        $fromDate = date("Y-m-d ",strtotime($request->from_date));
        $toDate = date("Y-m-d",strtotime($request->to_date));
        // Total records
        $totalRecords = PollingUnit::count();

        $list = PollingUnit::with(["lga","ward"])->orderBy("created_at", "DESC");

        if (request()->ajax()) {
            if($request->from_date){
                $list = $list->whereDate('created_at','>=', $fromDate);
            }

            if($request->to_date){
                $list = $list->whereDate('created_at','<=', $toDate);
            }

            if($searchword){
                $list = $list->where('name','like', '%'.$searchword.'%');
            }

            $list = $list->paginate($limit, ["*"], 'page', $page);

            $num = 1;
            $items = array();
            foreach ($list->items() as $idx => $row) {
                $action = '';

                $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/pollingunits/view/'.$row['id']).' "><i class="fas fa-eye"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/pollingunits/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "ward_name" => $row['ward']['name'],
                    "ward_id" => $row['ward_id'],
                    "lga_name" => $row['lga']['name'],
                    "lga_id" => $row['lga_id'],
                    "local_government" => $row['local_government'],
                    "created_at" => $row['created_at']->format('d M Y, g:i A'),
                    "updated_at" => $row['updated_at']->format('d M Y, g:i A'),
                    "action" => $action
                );

                $num++;
            }

            //-- START CREATE JSON RESPONSE FOR DATATABLES
            $response = array(
                "draw" => (int)$draw,
                "recordsTotal" => (int)$totalRecords,
                "recordsFiltered" => (int)$list->total(),
                "data" => $items
            );

            return response()->json($response);

        }

      
        
        return view("pollingunits.index", compact("list"));
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
        $data = $request->only(['name' , 'local_government' , 'lga_id' , 'wards_id']);
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
        $data = $request->only(['name', 'local_government' ,'lga_id' , 'wards_id']);
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
