<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FederalConstituency;

class FederalConstituenciesController extends Controller
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
        $totalRecords = FederalConstituency::count();
        $list = FederalConstituency::with('senatorialdistrict')->orderBy("created_at", "DESC");

        if (request()->ajax()) {
            if($searchword){
                $list = $list->where('name','like', '%'.$searchword.'%');
            }

            $list = $list->paginate($limit, ["*"], 'page', $page);

            $num = 1;
            $items = array();
            foreach ($list->items() as $id => $row) {
                $action = '';
               $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/federalconstituencies/view/'.$row['id']).' "><i class="fas fa-eye"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/federalconstituencies/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs col-1 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "senatorialdistrict" => $row->senatorialdistrict?$row->senatorialdistrict->name:'',
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
        
        return view("federalconstituencies.index", compact("list"));
    }


    /**
     * getList return all avilable state to use it in dropdown select2 ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        $search = $request->search;
        $lgas = State::select("id" , "name as text")
        ->where('name', 'like', '%' .$search . '%')
        ->orderBy("created_at", "DESC")
        ->get();
        return response()->json($lgas);
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
            'name' => 'required'
        ]);
        $data = $request->only(['name' , 'senatorial_district_id']);
        $item = FederalConstituency::create($data);
        return response()->json(['msg'=>"Federal Constituency created successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = FederalConstituency::find($id);
        return view("federalconstituencies.details", compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = FederalConstituency::find($id);
        return view("federalconstituencies.edit", compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $data = $request->only(['name' , 'senatorial_district_id']);
        $item = FederalConstituency::find($request->id);
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
        $item = FederalConstituency::find($id);
        if($item){
            $item->delete();
            return response()->json('200');
        }
    }
}
