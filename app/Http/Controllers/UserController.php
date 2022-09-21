<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
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
        $users = User::orderBy("created_at", "DESC")->get();
        $roles=Roles::orderBy("created_at", "DESC")->get();
        $fromDate=date("Y-m-d ",strtotime($request->from_date));
        $toDate=date("Y-m-d",strtotime($request->to_date));

        if (request()->ajax()) {
            if(!empty($request->from_date)){
                $users = User::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
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
            ->addColumn('role_id', function ($data) {
                $role=$data->roles;

                if(isset($role->toArray()[0])) {
                    $role_name=$role->toArray()[0]['name'];
                } else {
                    $role_name = 'No Roles Selected';
                }
                return $role_name;
            })
            ->addColumn('created_at', function ($row) { 
                $create_date = "<span style='display:none;'>".$row->created_at->timestamp."</span>".e($row->created_at->format('d M Y, g:i A'));
                return $create_date;
            })             
            ->addColumn('action', function ($data) {
                $action = '';
                
                $action .= '<a class="btn btn-info btn-sm" href="'.url("/user/view/$data->id").'">
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

            ->rawColumns(['checkbox','checkbox2', 'group', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("user.index", compact("users","roles"));
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
        // $user->profile_picture =  $request->profile_picture;
        $role_name = Roles::where("id","=",$request->role_id)->first();
        if(!empty($role_name)) {
            $role_name = $role_name->name;
        } else {
            $role_name = '';
        }
        $user->assignRole($role_name);

        if (!$user->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return response()->json(['msg'=>"User created successfully"], 200);
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
        $roles=Roles::orderBy("created_at", "DESC")->get();
        $role=$user->roles;
        if(isset($role->toArray()[0])) {
            $role_name=$role->toArray()[0]['name'];
            $user->roleid = $role->toArray()[0]['id'];
            $role = $role_name;
        } else {
            $role = 'No Roles Selected';
            $user->roleid = 0;
        }

        return view("user.details", compact("user","roles","role"));
    }

    public function update(Request $request) {
        $user = User::find($request->id);
        $user->syncRoles([]);
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
        $role_name = Roles::where("id","=",$request->role_id)->first();
        if(!empty($role_name)) {
            $role_name = $role_name->name;
        } else {
            $role_name = '';
        }
        $user->assignRole($role_name);

        if (!$user->save()) {
        }
        return back()->withInput();

    }

}
