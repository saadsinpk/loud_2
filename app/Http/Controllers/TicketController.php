<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
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
        $totalRecords = Ticket::count();
        $list = Ticket::orderBy("created_at", "DESC");

        if (request()->ajax()) {
            if($searchword){
                $list = $list->where('name','like', '%'.$searchword.'%');
            }

            $list = $list->paginate($limit, ["*"], 'page', $page);

            $num = 1;
            $items = array();
            foreach ($list->items() as $id => $row) {
                $action = '';
             /*  $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/constituencies/view/'.$row['id']).' "><i class="fas fa-eye"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" data-kt-table-filter="edit_row" href="'.url('/constituencies/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';*/

                $action .= '<a class="btn btn-xs col-1 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "hash" => $row['hash'],
                    "data" => $row['assedatambly'],
                    "expires" => $row['expires'],
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
        
        return view("tickets.index", compact("list"));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Ticket::find($id);
        if($item){
            $item->delete();
            return response()->json('200');
        }
    }
}
