<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

class MeetingController extends Controller
{
    function __construct()
    {
    }

    public function dashboard() {
        return view("dashboard");
    }

    public function index(Request $request) {
        $fromDate=date("Y-m-d ",strtotime($request->from_date));
        $toDate=date("Y-m-d",strtotime($request->to_date));
        $users = User::role('user')->orderBy("created_at", "DESC")->get();
        $meetings = Meeting::orderBy("created_at", "DESC")->get();
        if (request()->ajax()) {
            if(!empty($request->from_date)){
                $meetings = Meeting::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
            }
            return DataTables::of($meetings)
            ->addColumn('meeting', function ($data) {
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
                                <a href="'.url("/meeting/view/$data->id").'" class="menu-link px-3">Edit</a>
                            </div>';


                $action .= '<div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-table-filter="delete_row">Delete</a>
                             </div>';


                $action .= "</div>";

                return $action;
            })

            ->rawColumns(['checkbox', 'meeting', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("meeting.index", compact("meetings","users"));
    }


    public function store(Request $request) {
        // echo 'test';
        // print_r($request->toArray);
        // exit();
        $meeting = new Meeting();
        $meeting->ended = $request->ended;
        $meeting->streamid = $request->stream_id;
        $meeting->streamtitle = $request->stream_title;
        $meeting->hostname = $request->host_name;
        
        
        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".rand(1,1000000).time().'.'.$extension;
            // $filename="post-".time().'.'.$extension;
            $file->move('uploads/postImages/',$filename);
            $savepath="uploads/postImages/".$filename;

            // $group->media=base64_encode(file_get_contents('uploads/postImages/'.$filename));
            $meeting->hostimage=$savepath;
            // $meeting->media=base64_encode(file_get_contents('uploads/postImages/'.$filename));
        }

        if (!$meeting->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return response()->json(['msg'=>"Meeting created successfully"], 200);
    }

    public function destroy ($id) {
        $meeting = Meeting::find($id);
        $meeting->delete();

        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        Meeting::whereIn("id", explode(",", $request->ids))->delete();
        return response()->json('200');
    }

    public function details($id) {
        $meeting = Meeting::find($id);
        if (!$meeting) {
            return abort(404);
        }

        return view("meeting.details", compact("meeting"));
    }

    // public function notification() {
         // $meeting = Meeting::find($id);
         // $users = User::role('user')->orderBy("created_at", "DESC")->get();
         // $userName = User::where("id","=",$meeting->user_id)->first()->name;
         // if (!$meeting) {
         //     return abort(404);
         // }

    //     return view("meeting.notification");
    // }

    public function update(Request $request) {
        $meeting = Meeting::find($request->id);
        $meeting->ended = $request->ended;
        $meeting->streamid = $request->streamid;
        $meeting->streamtitle = $request->streamtitle;
        $meeting->hostname = $request->hostname;
        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".rand(1,1000000).time().'.'.$extension;
            // $filename="post-".time().'.'.$extension;
            $file->move('uploads/postImages/',$filename);
            $savepath="uploads/postImages/".$filename;
            $meeting->hostimage=$savepath;
            // $meeting->media=base64_encode(file_get_contents('uploads/postImages/'.$filename));
        }

        if (!$meeting->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return back()->withInput();
    }
}
