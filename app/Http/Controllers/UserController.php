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

    public function index(Request $request) {
        
        $draw = $request->get('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $searchword = $request->input('searchword');
        $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
        $limit = (int)$length > 0 ? $length : 10;
        $roles = Roles::orderBy("created_at", "DESC")->get();
        $fromDate = date("Y-m-d ",strtotime($request->from_date));
        $toDate = date("Y-m-d",strtotime($request->to_date));
        // Total records
        $totalRecords = User::role('user')->count();

        $users = User::role('user')->with('roles')->orderBy("created_at", "DESC");

        if (request()->ajax()) {
            if($request->from_date){
                $users = $users->whereDate('created_at','>=', $fromDate);
            }

            if($request->to_date){
                $users = $users->whereDate('created_at','<=', $toDate);
            }

            if($searchword){
                $users = $users->where('name','like', '%'.$searchword.'%');
            }

            $users = $users->paginate($limit, ["*"], 'page', $page);
           
            $num = 1;
            $items = array();
            foreach ($users->items() as $idx => $row) {
                $action = '';
                $action .= '<a class="btn btn-xs btn-success col-3 mr-2" href="'.url('/user/view/'.$row['id']).'"><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs btn-danger btn-sm col-3 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                if(!empty($row['profile_picture'])){
                    $profile_picture = '<img src="'.url('uploads/users_images/'.$row['profile_picture']).'" width="36" height="36" />';
                }else{
                    $profile_picture = '<img src="'.asset('assets/media/avatars/avatar.png').'" width="36" height="36"/>';
                }

                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "roles" => $row['roles'],
                    "role_name" => $row['roles'][0]->name,
                    "profile_picture" => $profile_picture,
                    "name" => $row['name'],
                    "email" => $row['email'],
                    "created_at" => $row['created_at'],
                    "action" => $action
                );

                $num++;
            }

            //-- START CREATE JSON RESPONSE FOR DATATABLES
            $response = array(
                "draw" => (int)$draw,
                "recordsTotal" => (int)$totalRecords,
                "recordsFiltered" => (int)$users->total(),
                "data" => $items
            );

            return response()->json($response);

        }
        
        return view("user.index", compact("roles"));
    }


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required_with:confirm-password|string|same:confirm-password',
            'confirm-password'   =>  'required|string|min:8',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {    
            return  response()->json(['msg'=>$validator->messages('*')->first()], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->profile_picture =  '';

        // upload image
        if($request->file('profile_picture')){
            $file = $request->file('profile_picture');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/users_images'), $filename);
            $user->profile_picture =  $filename;
        }

        $role_name = Roles::where("id","=",$request->role_id)->first();
        if(!empty($role_name)) {
            $role_name = $role_name->name;
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
