<?php

namespace App\Http\Controllers;

use App\Models\SenatorialDistrict;
use Illuminate\Http\Request;

class SenatorialDistrictController extends Controller
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
        // Total records
        $totalRecords = SenatorialDistrict::count();
        $list = SenatorialDistrict::with('state')->orderBy("created_at", "DESC");

        if (request()->ajax()) {
           
            if($searchword){
                $list = $list->where('name','like', '%'.$searchword.'%');
            }

            $list = $list->paginate($limit, ["*"], 'page', $page);

            $num = 1;
            $items = array();
            foreach ($list->items() as $id => $row) {
                $action = '';
               $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/senatorialdistricts/view/'.$row['id']).' "><i class="fas fa-eye"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/senatorialdistricts/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs col-1 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "state_id" => $row['state_id'],
                    "state_name" => $row->state?$row->state->name:'',
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
        
        return view("senatorialdistricts.index", compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'state_id' => 'required'
        ]);
        $data = $request->only(['name','state_id']);
        $item = SenatorialDistrict::create($data);
        return response()->json(['msg'=>"SenatorialDistrict created successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = SenatorialDistrict::find($id);
        return view("senatorialdistricts.details", compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = SenatorialDistrict::find($id);
        return view("senatorialdistricts.details", compact('item'));
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
            'state_id' => 'required',
        ]);
        $data = $request->only(['name' , 'state_id']);
        $item = SenatorialDistrict::find($request->id);
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
        $item = SenatorialDistrict::find($id);
        if($item){
            $item->delete();
            return response()->json('200');
        }
    }
}
