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
                $action .= '<a class="btn btn-info btn-sm" href="'.url("/roles/view/$data->id").'">
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