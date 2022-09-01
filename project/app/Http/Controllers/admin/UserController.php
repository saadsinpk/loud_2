<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use App\Models\Role as UserRole;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(Request $request)
    {
        if($request->ajax()){
        $query = User::orderby('id', 'desc')->where('id', '>', 0);
        if($request['search'] != ""){
            $query->where('name', 'like', '%'. $request['search'] .'%');
        }
        $users = $query->paginate(10);
        return (string) view('admin.user.search', compact('users'));
        }
        if(Auth::user()->hasRole('CEO')){
        $page_title = 'All P.M';
        $branches=Branch::orderby('id' , 'desc')->get();
        $users = User::role('P.M')->orderBy('id','DESC')->paginate(10);
        return view('admin.user.index', compact('users','page_title','branches'));
        }
        elseif(Auth::user()->hasRole('P.M')){
        $page_title = 'All Users';
        $users = User::role(['Senior Agent','Team lead','Agent'])->where('PM_id' , '=' , Auth::user()->id)->orderBy('id','DESC')->paginate(10);
        return view('admin.user.index', compact('users','page_title'));
        }
        elseif(Auth::user()->hasRole('Team lead')){
        $page_title = 'All Agent';
        $users = User::role('Agent')->orderBy('id','DESC')->paginate(10);
        return view('admin.user.index', compact('users','page_title'));
        }
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('CEO')){
        $page_title = 'Add P.M';
        $clientIP = request()->ip(); 
        $branches=Branch::orderby('id' , 'desc')->get();
        return view('admin.user.create',compact('page_title','branches','clientIP'));
        }
        elseif(Auth::user()->hasRole('P.M')){
        $page_title = 'Add Users';
        $clientIP = request()->ip(); 
        $roles = Role::orderby('id', 'desc')->where('name' ,'!=', 'P.M')->where('name' ,'!=', 'CEO')->get();
        return view('admin.user.create',compact('roles','page_title','clientIP'));
        }
        elseif(Auth::user()->hasRole('Senior Agent')){
        $page_title = 'Add Team lead';
        $clientIP = request()->ip(); 
        return view('admin.user.create',compact('page_title','clientIP'));
        }
        elseif(Auth::user()->hasRole('Team lead')){
        $page_title = 'Add Agent';
        $clientIP = request()->ip(); 
        return view('admin.user.create',compact('page_title','clientIP'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $user= new User();
        $user->PM_id = Auth::user()->id;
        $user->branch_id = $request->branch;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->Ip_address = $request->Ip_address;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
                        ->with('message','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_title = 'Edit User';
        $user = User::with('roles')->find($id);
        if(Auth::user()->hasRole('CEO')){
        $page_title = 'Add P.M';
        $branches=Branch::orderby('id' , 'desc')->get();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.user.edit',compact('user','page_title','branches','userRole'));
        }
        elseif(Auth::user()->hasRole('P.M')){
        $page_title = 'Edit User';
        $roles = Role::orderby('id', 'desc')->where('name' ,'!=', 'P.M')->where('name' ,'!=', 'CEO')->get();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.user.edit',compact('roles','user','page_title','userRole'));
        }
        // elseif(Auth::user()->hasRole('Senior Agent')){
        // $page_title = 'Add Team lead';
        // $userRole = $user->roles->pluck('name','name')->all();
        // return view('admin.user.edit',compact('user','userRole', 'page_title'));
        // }
        elseif(Auth::user()->hasRole('Team lead')){
        $page_title = 'Add Agent';
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.user.edit',compact('user','userRole', 'page_title'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'email' => 'required|max:200|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        // $input = $request->all();
        // if(!empty($input['password'])){
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = Arr::except($input,array('password'));
        // }

       
        $user = User::find($id);
        $user->branch_id = $request->branch;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->update();
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
                        ->with('message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }


    public function seniorAgent()
    {
        if(Auth::user()->hasRole('CEO')){
        $page_title = 'All Senior Agent';
        $senior_agents = User::role('Senior Agent')->orderBy('id','DESC')->paginate(10);
        return view('admin.user.senior_agent' , compact('page_title' , 'senior_agents'));
        }
    }


    public function teamLead()
    {
        if(Auth::user()->hasRole('CEO')){
        $page_title = 'All Team Lead';
        $team_leads = User::role('Team lead')->orderBy('id','DESC')->paginate(10);
        return view('admin.user.team_lead' , compact('page_title' , 'team_leads'));
        }
    }


    public function agent()
    {
        if(Auth::user()->hasRole('CEO')){
        $page_title = 'All Agent';
        $agents = User::role('Agent')->orderBy('id','DESC')->paginate(10);
        return view('admin.user.agent' , compact('page_title' , 'agents'));
        }
    }
}
