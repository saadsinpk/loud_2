<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index','show']]);
                // $this->middleware('permission:product-create', ['only' => ['create','store']]);
                // $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
                // $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function dashboard() {
        $total_user = User::role('user')->count();
        //$totalRoles = Role::get()->count();
        
        return view("dashboard", compact("total_user"));
    }

    public function index() {
        $users = User::role('superAdmin')
        ->with('roles')
        ->orderBy("created_at", "DESC")->get();
        if (request()->ajax()) {
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
 
                $action .= '<a class="btn btn-xs btn-success col-3 mr-2" href="'.url("/admins/view/$data->id").'"><i class="fas fa-pencil-alt"></i></a>';


                $action .= '<a class="btn btn-xs btn-danger col-3 mr-2" href="#" data-kt-table-filter="delete_row"><i class="fas fa-trash"></i></a>';
                return $action;
            })

            ->rawColumns(['checkbox', 'group', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("admins.index", compact("users"));
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
        $user->assignRole('superAdmin');
        if (!$user->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return response()->json(['msg'=>"Admin created successfully"], 200);
    }

    public function destroy ($id) {
        $user = User::find($id);
        $user->delete();
        $user->syncRoles('superAdmin');

        if($user->avatar) {
            $path = public_path('uploads/avatar/'.$user->avatar.'');
    
            unlink($path);
        }

        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        $users = User::whereIn("id", explode(",", $request->ids))->get();
        User::whereIn("id", explode(",", $request->ids))->delete();
        foreach ($users as $user) {
            $user->syncRoles('superAdmin');
            if($user->avatar) {
                $path = public_path('uploads/avatar/'.$user->avatar.'');
        
                unlink($path);
            }
        }
        return response()->json('200');
    }

    public function details($id) {
        $user = User::find($id);
        if (!$user) {
            return abort(404);
        }

        return view("admins.details", compact("user"));
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
                            return  response()->json(['errors'=>$validator->errors()], 422);
                        }
                    }
                }
            }
            if($key == "new_password" || "old_password" || "confirmed_password") {
                if($request->old_password || $request->new_password) {
                    $request->validate([
                        'old_password'   => '|required',
                        'new_password'   =>  'required_with:confirmed_password|string|same:confirmed_password',
                        'confirmed_password'   =>  'required_with:new_password'
                    ]);
                    
                    if (Hash::check($request->old_password, $user->password)) { 
                        $user->fill([
                         'password' => Hash::make($request->new_password)
                         ])->save();
                     
                         return response()->json($request->new_password);
                     } else {
                         return abort(401);
                     }
                }
            }
            if($key == "avatar") {
                // if($value == "") {

                // }else {
                    $request->validate([
                        'avatar' => 'image|max:50000'
                    ]);
                    
                    $file = $value;
                    $fileName = time().'_'.$file->getClientOriginalName();
                    $value->move(public_path('uploads/avatar'), $fileName);
        
                    $value = time().'_'. $file->getClientOriginalName();
                // }
            }

            $user[$key] = $value;
            $user->save();
        }
    }


}
