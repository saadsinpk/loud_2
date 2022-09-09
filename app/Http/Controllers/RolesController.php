<?php

namespace App\Http\Controllers;

use DB;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Role_Permissions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;



class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // Role::orderBy('id','DESC');
        $roles = Role::with("permissions")->orderBy("created_at", "DESC")->get();
        $permissions = Permission::get();
        
        $fromDate=date("Y-m-d ",strtotime($request->from_date));
        $toDate=date("Y-m-d",strtotime($request->to_date));
        // echo "<pre>";
        // print_r($permissions->toArray());
        // echo "</pre>";
        // exit();
        if (request()->ajax()) {
            if(!empty($request->from_date)){
                $roles = Role::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
            }
            return DataTables::of($roles)
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
            ->addColumn('permissions.name', function ($data) {
                $checkbox2='';
                foreach ($data['permissions'] as $key => $value) {
                    $checkbox2.=ucfirst($value->name).",";
                }
                $checkbox2=rtrim($checkbox2,",");
                return $checkbox2;
            })
            ->addColumn('updated_at', function ($row) { 
                $updated_at = "<span style='display:none;'>".$row->updated_at->timestamp."</span>".e($row->updated_at->format('d M Y, g:i A'));
                return $updated_at;
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
                                <a href="'.url("/roles/view/$data->id").'" class="menu-link px-3">Edit</a>
                            </div>';


                $action .= '<div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-table-filter="delete_row">Delete</a>
                             </div>';


                $action .= "</div>";

                return $action;
            })

            ->rawColumns(['checkbox','checkbox2', 'group', 'action', 'updated_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("roles.index", compact("roles","permissions"));    
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $permissions = Permission::get();
    //     return view('roles.create', compact('permissions'));
    // }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));
    
        return response()->json(['msg'=>"Role created successfully"], 200);
    }
    public function details($id) {
        
        $role = Role::find($id);
        $rolePermissions = $role->permissions->pluck('name')->toArray();
        $permissions = Permission::get();
        // $permissions = Permission::where("id","=",$rolePermissions->id)->first()->name;

        return view("roles.details", compact('role', 'rolePermissions', 'permissions'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($request->id);
        $role->name = $request->name;
        $break_permissions=explode(",",$request->permission);
        $role->syncPermissions($break_permissions);
        $role->save();
        
        if (!$role->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        };
    }
    public function destroy ($id) {
        $role = Role::find($id);
        $role->delete();

        Role_Permissions::where("role_id","=",$id)->delete();

        return response()->json('200');
    }
}