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
                                <a href="'.url("/mypermissions/view/$data->id").'" class="menu-link px-3">Edit</a>
                            </div>';


                $action .= '<div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-table-filter="delete_row">Delete</a>
                             </div>';


                $action .= "</div>";

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