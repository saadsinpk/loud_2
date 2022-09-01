<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Vote;
use App\Models\User;
use App\Models\PollOptions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;
use DataTables;

class PollController extends Controller
{
    function __construct()
    {
    }

    public function dashboard() {
        return view("dashboard");
    }

    public function index(Request $request) {
        $users = User::role('user')->orderBy("created_at", "DESC")->get();
        $polls = Poll::with("votes")->orderBy("created_at", "DESC")->get();

        $fromDate=date("Y-m-d ",strtotime($request->from_date));
        $toDate=date("Y-m-d",strtotime($request->to_date));

        if (request()->ajax()) {
                if(!empty($request->from_date)){
                    $polls = Poll::with("votes")->whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
                }
                return DataTables::of($polls)
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
                ->addColumn('user_id', function ($data) {
                    $checkbox2='';
                    $found=User::where("id","=",$data->user_id)->first();
                    if($found){

                        $checkbox2 = User::where("id","=",$data->user_id)->first()->name;
                    }
                    return $checkbox2;
                })
                ->addColumn('created_at', function ($row) { 
                    $create_date = "<span style='display:none;'>".$row->created_at->timestamp."</span>".e($row->created_at->format('d M Y, g:i A'));
                    return $create_date;
                })             
                ->addColumn('total_votes', function ($row) { 
                    $total_votes = count($row->votes);
                    return $total_votes;
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
                                    <a href="'.url("/poll/view/$data->id").'" class="menu-link px-3">Edit</a>
                                </div>';


                    $action .= '<div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-table-filter="delete_row">Delete</a>
                                 </div>';


                    $action .= "</div>";

                    return $action;
                })

                ->rawColumns(['checkbox','checkbox2', 'group', 'action', 'created_at'])
                ->addIndexColumn()
                ->make(true);
        }
        
        return view("poll.index", compact("polls","users"));
    }


    public function store(Request $request) {


        $poll = new Poll();
        // $poll->date_filter = $request->date_filter;
        $poll->user_id = $request->user_id;
        $poll->question = $request->question;
        $poll->ends_in = $request->ends_in;
        $poll->is_people_share =  $request->is_people_share;
        $poll->hide_creator_detail =  $request->hide_creator_detail;
        if (!$poll->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }

        $poll_array = array();
        foreach ($request->options as $option_key => $option_value) {
            $poll_options = new PollOptions();
            $poll_options->name = $option_value;
            $poll_options->poll_id = $poll->id;
            $poll_options->save();
            $poll_array[] = $poll_options->id;

        }
        $poll->options =  json_encode($poll_array);

        if (!$poll->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return response()->json(['msg'=>"Admin created successfully"], 200);
    }

    public function destroy($id) {
        $poll = Poll::find($id);
        $poll->delete();

        PollOptions::where("poll_id","=",$id)->delete();

        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        $polls = Poll::whereIn("id", explode(",", $request->ids))->get();
        foreach ($polls as $poll) {
            PollOptions::where("poll_id","=",$poll->id)->delete();
        }
        Poll::whereIn("id", explode(",", $request->ids))->delete();
        return response()->json('200');
    }

    public function details($id) {
        $poll = Poll::find($id);
        $users = User::role('user')->orderBy("created_at", "DESC")->get();
        $userName = User::where("id","=",$poll->user_id)->first()->name;
        $total_vote = Vote::where("poll_id","=",$poll->id)->count();
        $PollOptions = PollOptions::where("poll_id","=",$poll->id)->get();
        if (!$poll) {
            return abort(404);
        }

        return view("poll.details", compact("poll","total_vote","PollOptions","users","userName"));
    }

    public function update(Request $request) {
        $poll = Poll::find($request->id);
        PollOptions::where("poll_id","=",$request->id)->delete();

        // $poll->date_filter = $request->date_filter;
        $poll->user_id = $request->user_id;
        $poll->question = $request->question;
        $poll->ends_in = $request->ends_in;
        $poll->is_people_share =  $request->is_people_share;
        $poll->hide_creator_detail =  $request->hide_creator_detail;
        if (!$poll->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }

        $poll_array = array();
        foreach ($request->options as $option_key => $option_value) {
            $poll_options = new PollOptions();
            $poll_options->name = $option_value;
            $poll_options->poll_id = $poll->id;
            $poll_options->save();
            $poll_array[] = $poll_options->id;

        }
        $poll->options =  json_encode($poll_array);

        if (!$poll->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return back()->withInput();
    }
}
