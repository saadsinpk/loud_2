<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poll;
use App\Models\Post;
use App\Models\Report;
use App\Models\Group;
use App\Models\Live;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Willywes\AgoraSDK\RtcTokenBuilder;

class AdminController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index','show']]);
                // $this->middleware('permission:product-create', ['only' => ['create','store']]);
                // $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
                // $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    //


    public static function Agora_GetToken($user_id){
    
        $appID = "c5f22fb73e6240d380f29ac9af1d8c31";
        $appCertificate = "2fa50dacd540405980314c8c6a1bbfcf";
        $channelName = "LoudLive";
        $uid = $user_id;
        $uidStr = ($user_id) . '';
        $role = RtcTokenBuilder::RolePublisher;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
    
        return RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
    
    }

    public function dashboard() {
        $total_user = User::count();
        $total_poll = Poll::count();
        $total_post = Post::count();
        $total_report = Report::count();
        $total_group = Group::count();
        $total_live = Live::count();
        
        // $token = '006c5f22fb73e6240d380f29ac9af1d8c31IAB3TOMZTReXusweoYRqfrjliQAGAPcMikZ6+qAg7P4L4rUlyoMAAAAAEACGukDPVxTsYgEAAQBXFOxi';
        // $appCertificate = '2fa50dacd540405980314c8c6a1bbfcf';
        // $channel = 'LoudLive';
        // $uid = '123456';
        // print_r(AccessToken::initWithToken($token, $appCertificate, $channel, $uid));
        // print_r($this->Agora_GetToken("123456"));
        // exit();

        return view("dashboard", compact("total_user","total_poll","total_post","total_report","total_group","total_live"));
    }

    public function index() {
        $users = User::role('superAdmin')->orderBy("created_at", "DESC")->get();
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
                                <a href="'.url("/admins/view/$data->id").'" class="menu-link px-3">Edit</a>
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
