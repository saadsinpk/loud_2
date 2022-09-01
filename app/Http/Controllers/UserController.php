<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

class UserController extends Controller
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

        $fromDate=date("Y-m-d ",strtotime($request->from_date));
        $toDate=date("Y-m-d",strtotime($request->to_date));

        if (request()->ajax()) {
            if(!empty($request->from_date)){
                $users = User::role('user')->whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
            }
            return DataTables::of($users)
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
                                <a href="'.url("/user/view/$data->id").'" class="menu-link px-3">Edit</a>
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
        
        return view("user.index", compact("users"));
    }


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required_with:confirm-password|string|same:confirm-password',
            'confirm-password'   =>  'required|string|min:8',
        ]);

        if ($validator->fails()) {    
            return  response()->json(['msg'=>$validator->messages('*')->first()], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->gender =  $request->gender;
        $user->platform =  $request->platform;
        $user->age =  $request->age;
        $user->profile_picture =  $request->profile_picture;
        $user->assignRole('user');
        if (!$user->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return response()->json(['msg'=>"Admin created successfully"], 200);
    }

    public function destroy ($id) {
        $user = User::find($id);
        $user->delete();
        $user->syncRoles('user');

        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        $users = User::whereIn("id", explode(",", $request->ids))->get();
        User::whereIn("id", explode(",", $request->ids))->delete();
        foreach ($users as $user) {
            $user->syncRoles('user');
        }
        return response()->json('200');
    }

    public function details($id) {
        $user = User::find($id);
        if (!$user) {
            return abort(404);
        }

        return view("user.details", compact("user"));
    }

    public function update(Request $request) {
        $user = User::find($request->id);
        $users = User::where("id", "!=", $request->id)->get();

        foreach ($request->all() as $key => $value) {
            if($key == "email") {
                foreach ($users as $u) {
                    if($u->email == $value) {
                        $validator = Validator::make($request->all(), [
                            'email' => 'required|string|email|unique:users'
                        ]);
                        
                        if ($validator->fails()) {    
                            // return back()->withInput();
                        }
                    }
                }
            }
            unset($user['confirm-password']);

        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->gender =  $request->gender;
        $user->platform =  $request->platform;
        $user->age =  $request->age;
        $user->profile_picture =  $request->profile_picture;
        if (!$user->save()) {
            // return back()->withInput();
        }
        return back()->withInput();

    }

}
