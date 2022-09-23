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
        $totalRecords = Ward::count();

        $list = Ward::with("lga")->orderBy("created_at", "DESC");

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
                $action .= '<a class="btn btn-xs btn-success col-3 mr-2" data-kt-table-filter="edit_row" href="'.url('/wards/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs btn-danger btn-sm col-3 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "name" => $row['name'],
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

                
        return view("ward.index", compact("list"));
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
            'lga_id' => 'required',
            'local_government' => 'required'
        ]);
        $data = $request->only(['name' , 'local_government' , 'lga_id']);
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
            'lga_id' => 'required',
            'local_government' => 'required'
        ]);
        $data = $request->only(['name', 'local_government','lga_id']);
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
