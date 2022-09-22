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
       // $roles = Role::with("permissions")->orderBy("created_at", "DESC")->get();
        $permissions = Permission::get();
        
        $draw = $request->get('draw');
        $start = $request->input('start');
        $length = $request->input('length');
        $searchword = $request->input('searchword');
        $page = (int)$start > 0 ? ($start / $length) + 1 : 1;
        $limit = (int)$length > 0 ? $length : 10;
        $fromDate = date("Y-m-d ",strtotime($request->from_date));
        $toDate = date("Y-m-d",strtotime($request->to_date));
        // Total records
        $totalRecords = Role::count();
        $roles = Role::with('permissions')->orderBy("created_at", "DESC");

        if (request()->ajax()) {
            if($request->from_date){
                $roles = $roles->whereDate('created_at','>=', $fromDate);
            }

            if($request->to_date){
                $roles = $roles->whereDate('created_at','<=', $toDate);
            }

            if($searchword){
                $roles = $roles->where('name','like', '%'.$searchword.'%');
            }

            $roles = $roles->paginate($limit, ["*"], 'page', $page);

            $num = 1;
            $items = array();
            foreach ($roles->items() as $idx => $row) {
                $action = '';
                $action .= '<a class="btn btn-xs btn-success col-3 mr-2" data-kt-table-filter="edit_row" href="'.url('/roles/view/'.$row['id']).' "><i class="fas fa-pencil-alt"></i></a>';

                $action .= '<a class="btn btn-xs btn-danger btn-sm col-3 mr-2" href="#" data-kt-table-filter="delete_row" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></a>';

                $permissions = '<small>';
                foreach ($row->permissions as $key => $value) {
                    $permissions.="- ".ucfirst($value->name)."<br>";
                }

                $permissions.= '</small>';
                $items[] = array(
                    "no" => $num,
                    "id" => $row['id'],
                    "permissionsname" => $permissions,
                    "name" => $row['name'],
                    "created_at" => $row['created_at'],
                    "updated_at" => $row['updated_at'],
                    "action" => $action
                );

                $num++;
            }

            //-- START CREATE JSON RESPONSE FOR DATATABLES
            $response = array(
                "draw" => (int)$draw,
                "recordsTotal" => (int)$totalRecords,
                "recordsFiltered" => (int)$roles->total(),
                "data" => $items
            );

            return response()->json($response);
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