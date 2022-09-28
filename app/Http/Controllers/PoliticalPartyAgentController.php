<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\Models\PoliticalPartyAgent;
use App\Http\Requests\PoliticalPartyAgentStoreRequest;
use App\Http\Requests\PoliticalPartyAgentUpdateRequest;

class PoliticalPartyAgentController extends Controller
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
        $totalRecords = PoliticalPartyAgent::count();

        $list = PoliticalPartyAgent::with(["lga","ward","pollingunit"])->orderBy("created_at", "DESC");


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
                $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/politicalpartyagents/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/politicalpartyagents/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "political_party" => $row['political_party'],
                    "name" => $row['first_name']." ".$row['middle_name']." ".$row['last_name'],
                    "lga_name" => $row['lga']['name'],
                    "lga_id" => $row['lga_id'],
                    "latitude" => $row['latitude'],
                    "longitude" => $row['longitude'],
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

    
        return view("politicalpartyagents.index", compact("list"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PoliticalPartyAgentStoreRequest $request)
    {
        $data = $request->only(['political_party', 'agent_picture' , 'first_name' , 'middle_name' , 'last_name' , 'mobile' , 'wards_id', 'lga_id'  , 'polling_unit_id' , 'designation' , 'home_address' , 'extra_mobile' , 'signature_agent' , 'signature_auth_party_officials' , 'name_party_chairman' , 'signature_party_chairman' , 'name_electoral_officer' , 'signature_electoral_officer' ,'latitude','longitude']); 

        // upload image
        if($request->file('agent_picture')){
            $file = $request->file('agent_picture');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/agent_images'), $filename);
            $data['agent_picture'] = $filename;
        }

        $item = PoliticalPartyAgent::create($data);
        return response()->json(['msg'=>"Political party agent created successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id) {

        $politicalpartyagent = PoliticalPartyAgent::find($id);
        return view("politicalpartyagents.details", compact('politicalpartyagent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PoliticalPartyAgentUpdateRequest $request)
    {
        
        $data = $request->only(['political_party', 'first_name' , 'middle_name' , 'last_name' , 'mobile' , 'wards_id', 'lga_id'  , 'polling_unit_id' , 'designation' , 'home_address' , 'extra_mobile' , 'signature_agent' , 'signature_auth_party_officials' , 'name_party_chairman' , 'signature_party_chairman' , 'name_electoral_officer' , 'signature_electoral_officer' ,'latitude','longitude']); 

        // upload image
        if (($request->agent_picture) && ($request->file('agent_picture'))){
            $file = $request->file('agent_picture');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/agent_images'), $filename);
            $data['agent_picture'] = $filename;
        }

        $item = PoliticalPartyAgent::find($request->id);
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
        $item = PoliticalPartyAgent::find($id);
        $item->delete();
        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        PoliticalPartyAgent::whereIn("id", explode(",", $request->ids))->delete();
        return response()->json('200');
    }
}
