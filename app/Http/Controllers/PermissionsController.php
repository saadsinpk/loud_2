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

class PermissionsController extends Controller
{
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $permissions = Permission::all();

        $fromDate=date("Y-m-d ",strtotime($request->from_date));
        $toDate=date("Y-m-d",strtotime($request->to_date));

        if (request()->ajax()) {
            if(!empty($request->from_date)){
                $permissions = Permission::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
            }
            return DataTables::of($permissions)
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
            ->addColumn('updated_at', function ($row) { 
                $updated_at = "<span style='display:none;'>".$row->updated_at->timestamp."</span>".e($row->updated_at->format('d M Y, g:i A'));
                return $updated_at;
            })             
            ->addColumn('action', function ($data) {
                $action = '';
                $action .= '<a class="btn btn-xs btn-success col-3 mr-2" href="'.url("/mypermissions/view/$data->id").'"><i class="fas fa-pencil-alt"></i></a>';


                $action .= '<a class="btn btn-xs btn-danger col-3 mr-2" href="#" data-kt-table-filter="delete_row"><i class="fas fa-trash"></i></a>';

                return $action;
            })

            ->rawColumns(['checkbox', 'group', 'action', 'updated_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("permissions.index", compact("permissions"));   
    }
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|unique:users,name'
        ]);

        Permission::create($request->only('name'));

        return response()->json(['msg'=>"Permission created successfully"], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', [
            'permission' => $permission
        ]);
    }


    public function details($id) {
        
        $permissions = Permission::find($id);

        return view("permissions.details", compact('permissions'));
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id
        ]);
        $permission = Permission::find($request->id);
        $permission->name = $request->name;

        
        // $permission->update($request->only('name'));
        $permission->save();
        if (!$permission->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        };
    }

    public function destroy ($id) {
        $permission = Permission::find($id);
        $permission->delete();

        return response()->json('200');
    }
}