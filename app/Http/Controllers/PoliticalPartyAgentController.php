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
    public function index()
    {
        $politicalpartyagents = PoliticalPartyAgent::with(["lga","ward","pollingunit"])->orderBy("created_at", "DESC")->get();

        if (request()->ajax()) {
            return DataTables::of($politicalpartyagents)
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
                
                $action .= '<a class="btn btn-info btn-sm" href="'.url("/politicalpartyagents/view/$data->id").'">
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
        
        return view("politicalpartyagents.index", compact("politicalpartyagents"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PoliticalPartyAgentStoreRequest $request)
    {
        $data = $request->only(['political_party', 'agent_picture' , 'name' , 'mobile' , 'wards_id', 'lga_id'  , 'polling_unit_id' , 'designation' , 'home_address' , 'extra_mobile' , 'signature_agent' , 'signature_auth_party_officials' , 'name_party_chairman' , 'signature_party_chairman' , 'name_electoral_officer' , 'signature_electoral_officer']); 

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
        
        $data = $request->only(['political_party', 'name' , 'mobile' , 'wards_id', 'lga_id'  , 'polling_unit_id' , 'designation' , 'home_address' , 'extra_mobile' , 'signature_agent' , 'signature_auth_party_officials' , 'name_party_chairman' , 'signature_party_chairman' , 'name_electoral_officer' , 'signature_electoral_officer']); 

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
