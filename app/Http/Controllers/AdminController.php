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

    public function index(Request $request) {

        $draw = $request->get('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $searchword = $request->input('searchword');
        $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
        $limit = (int)$length > 0 ? $length : 10;
        // Total records
        $totalRecords = User::role('superAdmin')->count();

        $users = User::role('superAdmin')->with('roles')->orderBy("created_at", "DESC");

        if (request()->ajax()) {

            if($searchword){
                $users = $users->where('name','like', '%'.$searchword.'%');
            }

            $users = $users->paginate($limit, ["*"], 'page', $page);
           
            $num = 1;
            $items = array();
            foreach ($users->items() as $idx => $row) {
                $action = '';

              //  $action .= '<a class="btn btn-xs btn-primary col-3 mr-2" href="'.url('/admins/view/'.$row['id']).'"><i class="fas fa-eye"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" href="'.url('/admins/view/'.$row['id']).'"><i class="fas fa-eye"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" href="'.url('/admins/view/'.$row['id']).'"><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs  col-1 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

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
                "recordsFiltered" => (int)$users->total(),
                "data" => $items
            );

            return response()->json($response);

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
