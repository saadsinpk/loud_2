<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

class GroupController extends Controller
{
    function __construct()
    {
    }
    //

    public function dashboard() {
        return view("dashboard");
    }

    public function index(Request $request) {
        $users = User::role('user')->orderBy("created_at", "DESC")->get();
        $groups = Group::orderBy("created_at", "DESC")->get();

        $fromDate=date("Y-m-d ",strtotime($request->from_date));
        $toDate=date("Y-m-d",strtotime($request->to_date));


        if (request()->ajax()) {

            if(!empty($request->from_date)){
                $groups = Group::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
            }
            return DataTables::of($groups)
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
                                <a href="'.url("/group/view/$data->id").'" class="menu-link px-3">Edit</a>
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
        
        return view("group.index", compact("groups","users"));
    }


    public function store(Request $request) {

        $group = new Group();
        $group->name = $request->name;
        $group->description = $request->description;
        $group->access = $request->access;
        $group->invite_peoples =  $request->invite_peoples;
        $group->user_id = $request->user_id;

        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".rand(1,1000000).time().'.'.$extension;
            $savepath="uploads/postImages/".$filename;
            $file->move('uploads/postImages/',$filename);

            // $group->media=base64_encode(file_get_contents('uploads/postImages/'.$filename));
            $group->media=$savepath;
        }
        if (!$group->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return response()->json(['msg'=>"Group created successfully"], 200);
    }

    public function destroy ($id) {
        $group = Group::find($id);
        $group->delete();

        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        Group::whereIn("id", explode(",", $request->ids))->delete();

        return response()->json('200');
    }

    public function details($id) {
        $group = Group::find($id);
        $users = User::role('user')->orderBy("created_at", "DESC")->get();
        $userName = User::where("id","=",$group->user_id)->first()->name;
        if (!$group) {
            return abort(404);
        }

        return view("group.details", compact("group","users","userName"));
    }

    public function update(Request $request) {
        $group = Group::find($request->id);

        $group->name = $request->name;
        $group->description = $request->description;
        $group->access = $request->access;
        $group->user_id = $request->user_id;
        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".rand(1,1000000).time().'.'.$extension;
            $savepath="uploads/postImages/".$filename;
            $file->move('uploads/postImages/',$filename);

            // $group->media=base64_encode(file_get_contents('uploads/postImages/'.$filename));
            $group->media=$savepath;
        }
        $group->invite_peoples =  $request->invite_peoples;

        if (!$group->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return back()->withInput();
        // return response()->json(['msg'=>"Admin created successfully"], 200);
    }
    public function add_user_to_group(Request $request) {
        
    }
}
