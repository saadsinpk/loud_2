<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Live;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

class LiveController extends Controller
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
        $lives = Live::orderBy("created_at", "DESC")->get();
        if (request()->ajax()) {
            if(!empty($request->from_date)){
                $lives = Live::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
            }
            return DataTables::of($lives)
            ->addColumn('live', function ($data) {
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
                                <a href="'.url("/live/view/$data->id").'" class="menu-link px-3">Edit</a>
                            </div>';


                $action .= '<div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-table-filter="delete_row">Delete</a>
                             </div>';


                $action .= "</div>";

                return $action;
            })

            ->rawColumns(['checkbox', 'live', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("live.index", compact("lives","users"));
    }


    public function store(Request $request) {

        $live = new Live();
        $live->title = $request->title;
        $live->description = $request->description;
        $live->user_id = $request->user_id;

        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".rand(1,1000000).time().'.'.$extension;
            // $filename="post-".time().'.'.$extension;
            $file->move('uploads/postImages/',$filename);
            $savepath="uploads/postImages/".$filename;

            // $group->media=base64_encode(file_get_contents('uploads/postImages/'.$filename));
            $live->media=$savepath;
            // $live->media=base64_encode(file_get_contents('uploads/postImages/'.$filename));
        }

        if (!$live->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return response()->json(['msg'=>"Live created successfully"], 200);
    }

    public function destroy ($id) {
        $live = Live::find($id);
        $live->delete();

        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        Live::whereIn("id", explode(",", $request->ids))->delete();
        return response()->json('200');
    }

    public function details($id) {
        $live = Live::find($id);
        $users = User::role('user')->orderBy("created_at", "DESC")->get();
        $userName = User::where("id","=",$live->user_id)->first()->name;
        if (!$live) {
            return abort(404);
        }

        return view("live.details", compact("live","users","userName"));
    }

    // public function notification() {
         // $live = Live::find($id);
         // $users = User::role('user')->orderBy("created_at", "DESC")->get();
         // $userName = User::where("id","=",$live->user_id)->first()->name;
         // if (!$live) {
         //     return abort(404);
         // }

    //     return view("live.notification");
    // }

    public function update(Request $request) {
        $live = Live::find($request->id);
        $live->title = $request->title;
        $live->description = $request->description;
        $live->user_id = $request->user_id;
        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".rand(1,1000000).time().'.'.$extension;
            // $filename="post-".time().'.'.$extension;
            $file->move('uploads/postImages/',$filename);
            $savepath="uploads/postImages/".$filename;
            $live->media=$savepath;
            // $live->media=base64_encode(file_get_contents('uploads/postImages/'.$filename));
        }

        if (!$live->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return back()->withInput();
    }
}
