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
                                <a href="'.url("/politicalpartyagents/view/$data->id").'" class="menu-link px-3">Edit</a>
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
        
        $data = $request->only(['political_party', 'agent_picture' , 'name' , 'mobile' , 'wards_id', 'lga_id'  , 'polling_unit_id' , 'designation' , 'home_address' , 'extra_mobile' , 'signature_agent' , 'signature_auth_party_officials' , 'name_party_chairman' , 'signature_party_chairman' , 'name_electoral_officer' , 'signature_electoral_officer']); 

        // upload image
        if($request->file('agent_picture')){
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
