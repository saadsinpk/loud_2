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
        $totalRecords = Lga::count();

        $list = Lga::with(['state','federalconstituency'])->orderBy("created_at", "DESC");

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

              $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/lgas/view/'.$row['id']).' "><i class="fas fa-eye"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/lgas/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs col-1 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "federal_constituency_id" => $row['federal_constituency_id'],
                    "state_id" => $row['state_id'],
                    "state_name" => $row->state?$row->state->name:'',
                    "federal_constituency_name" => $row->federalconstituency?$row->federalconstituency->name:'',
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
        
        return view("lga.index", compact("list"));
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
        $data = $request->only(['name' , 'federal_constituency_id' , 'state_id']);
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
        $data = $request->only(['name', 'federal_constituency_id' , 'state_id']);
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

}
