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
        $data = $request->only(['name' , 'lga_id']); ///
        $item = PoliticalPartyAgent::create($data);
        return response()->json(['msg'=>"political_party_agent created successfully"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id) {

        $political_party_agent = PoliticalPartyAgent::find($id);
        return view("politicalpartyagents.details", compact('political_party_agent'));
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
            'name' => 'required',
            'lga_id' => 'required'
        ]);
        $data = $request->only(['name', 'lga_id']); /////
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
