<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Branch;
use App\Models\User;
use App\Models\Role as UserRole;
use Spatie\Permission\Models\Role;
use File;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            if(Auth::user()->hasRole('CEO')){
            $query=Lead::orderby('id' , 'DESC')->where('id', '>' , 0);
            }
            if(Auth::user()->hasRole('P.M')){
            $query=Lead::orderby('id' , 'DESC')->where('id', '>' , 0)->where('PM_id' , '=' , Auth::user()->id);
            }
            if(Auth::user()->hasRole('Senior Agent')){
            $role=Role::where('name' , '=' , 'Senior Agent')->first();
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            $query=Lead::orderby('id' , 'DESC')->where('id', '>' , 0)->where('lead_asign' , $role->id)->where('PM_id' , '=' , $user->id);
            }
            if(Auth::user()->hasRole('Team lead')){
            $role=Role::where('name' , '=' , 'Team lead')->first();
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            $query=Lead::orderby('id' , 'DESC')->where('id', '>' , 0)->where('lead_asign' , $role->id)->where('PM_id' , '=' , $user->id);
            }
            if(Auth::user()->hasRole('Agent')){
            $role=Role::where('name' , '=' , 'Agent')->first();
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            $query=Lead::orderby('id' , 'DESC')->where('id', '>' , 0)->where('lead_asign' , $role->id)->where('PM_id' , '=' , $user->id);
            }
            if($request['search'] != ""){
                $query->where('customer_name' , 'like' , '%' . $request['search'] . '%');
            }
            if($request['status']!="All"){
                if($request['status'] == 2){
                    $request['status'] = 0;
                }
                $query->where('status' , $request['status']);
            }
            $leads = $query->paginate(10);
            return (string) view('admin.lead.search', compact('leads'));
        }
        $page_title = 'All Leads';
        if(Auth::user()->hasRole('CEO')){
            $leads=Lead::orderby('id' , 'DESC')->paginate(10);
        }
        elseif(Auth::user()->hasRole('P.M')){
            $leads=Lead::orderby('id' , 'DESC')->where('PM_id' , '=' , Auth::user()->id)->paginate(10);
        }
        elseif(Auth::user()->hasRole('Senior Agent')){
            $role=Role::where('name' , '=' , 'Senior Agent')->first();
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            $leads=Lead::orderby('id' , 'DESC')->where('lead_asign' , $role->id)->where('PM_id' , '=' , $user->id)->paginate(10);
        }
        elseif(Auth::user()->hasRole('Team lead')){
            $role=Role::where('name' , '=' , 'Agent')->first();
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            $leads=Lead::orderby('id' , 'DESC')->where('lead_asign' , $role->id)->where('PM_id' , '=' , $user->id)->paginate(10);
        }
        elseif(Auth::user()->hasRole('Agent')){
            $role=Role::where('name' , '=' , 'Agent')->first();
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            $leads=Lead::orderby('id' , 'DESC')->where('lead_asign' , $role->id)->where('PM_id' , '=' , $user->id)->paginate(10);
        }
        return view('admin.lead.index' , compact('leads' , 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasRole('CEO')){
            $page_title = 'Add Lead';
            $branches=Branch::orderby('id' , 'desc')->get();
            $PMs=User::role('P.M')->orderBy('id','DESC')->paginate(10);
            return view('admin.lead.create',compact('page_title','branches' ,'PMs'));
            }
        elseif(Auth::user()->hasRole('P.M')){
            $page_title = 'Add Lead';
            $roles = Role::orderby('id', 'desc')->where('name' ,'!=', 'P.M')->where('name' ,'!=', 'CEO')->get();
            return view('admin.lead.create',compact('page_title','roles'));
            }
        elseif(Auth::user()->hasRole('Senior Agent')){
            $page_title = 'Add Lead';
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            return view('admin.lead.create',compact('page_title','user'));
            }
        elseif(Auth::user()->hasRole('Team lead')){
            $page_title = 'Add Lead';
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            return view('admin.lead.create',compact('page_title','user'));
            }
        elseif(Auth::user()->hasRole('Agent')){
            $page_title = 'Add Lead';
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            return view('admin.lead.create',compact('page_title','user'));
            }
        else{
            $page_title = 'Add Lead';
            return view('admin.lead.create',compact('page_title'));
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
       if(Auth::user()->hasRole('CEO')){
            $this->validate($request ,[
            'branch' => 'required',
            ]);
       }
       else{
            $this->validate($request ,[
                'customer_name' => 'required',
                'customer_number' => 'required',
                'notes' => 'required|mimes:txt|max:4098',
                'mp3' => 'required|mimes:mp3',

            ]);
        }
        
        $lead= new Lead();
        
        if($file=$request->file('notes')){
            $filename = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move('public/admin/assets/lead_notes', $filename);
            $lead->notes = $filename;
        }
        
        if($file=$request->file('mp3')){
            $filename = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move('public/admin/assets/lead_mp3', $filename);
            $lead->mp3 = $filename;
        }
        
        // $lead->serial_number = $request->serial_number;
        $lead->branch_id = $request->branch;
        // if(Auth::user()->hasRole('CEO')){
        // $lead->PM_id = $request->PM;
        // }
        // elseif(Auth::user()->hasRole('Senior Agent')){
        // $lead->PM_id = $request->PM;
        // }
        // elseif(Auth::user()->hasRole('Team lead')){
        // $lead->PM_id = $request->PM;
        // }
        // elseif(Auth::user()->hasRole('Agent')){
        // $lead->PM_id = $request->PM;
        // }
        if(Auth::user()->hasRole('P.M')){
        $lead->PM_id = Auth::user()->id;
        }
        $lead->PM_id = $request->PM;
        $lead->lead_asign = $request->lead_asign;
        $lead->customer_name = $request->customer_name;
        $lead->customer_number = $request->customer_number;
        $lead->save();

        return redirect()->route('lead.index')->with('message' , 'Lead Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasRole('CEO')){
            $page_title = 'Edit Lead';
            $lead=Lead::findorfail($id);
            $branches=Branch::orderby('id' , 'desc')->get();
            $PMs=User::role('P.M')->orderBy('id','DESC')->get();
            return view('admin.lead.edit',compact('page_title','branches' ,'PMs','lead'));
            }
        elseif(Auth::user()->hasRole('P.M')){
            $page_title = 'Edit Lead';
            $lead=Lead::findorfail($id);
            $branches=Branch::orderby('id' , 'desc')->get();
            $PMs=User::role('P.M')->where('id', Auth::user()->id)->first();
            $roles = Role::orderby('id', 'desc')->where('name' ,'!=', 'P.M')->where('name' ,'!=', 'CEO')->get();
            return view('admin.lead.edit',compact('page_title','branches','lead','roles','PMs'));
            }
        elseif(Auth::user()->hasRole('Senior Agent')){
            $page_title = 'Edit Lead';
            $lead=Lead::findorfail($id);
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            return view('admin.lead.edit',compact('page_title','lead'));
            }
        elseif(Auth::user()->hasRole('Team lead')){
            $page_title = 'Edit Lead';
            $lead=Lead::findorfail($id);
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            return view('admin.lead.edit',compact('page_title','user','lead'));
            }
        elseif(Auth::user()->hasRole('Agent')){
            $page_title = 'Edit Lead';
            $lead=Lead::findorfail($id);
            $user=User::where('id' , '=' , Auth::user()->PM_id)->first();
            return view('admin.lead.edit',compact('page_title','user','lead'));
            }
            // $page_title = 'Edit Lead';
            // $lead=Lead::findorfail($id);
            // // $number = mt_rand(100000, 999999);
            // // $contents =file_get_contents('public/admin/assets/lead_notes/'.$lead->notes);
            // return view('admin.lead.edit' , compact('page_title','lead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $data = $request->notesss;
        
        $lead=Lead::findorfail($id);
        
        // Storage::put('public/admin/assets/lead_notes/'.$lead->notes, $request->input('notes'));
        
        
        // if(empty($request->notes)){
        //     $contentss = Storage::put('public/admin/assets/lead_notes/'.$lead->notes, $data);
            
        //     if($contentss){
        //         if($file=$request->file($contentss)){
        //             $filename = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
        //             $file->move('public/admin/assets/lead_notes', $filename);
        //             $lead->notes = $filename;
        //         }
        //     }
        // }else{
        //     if($file=$request->file('notes')){
        //         $filename = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
        //         $file->move('public/admin/assets/lead_notes', $filename);
        //         $lead->notes = $filename;
        //     }
        // }

        if($file=$request->file('notes')){
            $filename = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move('public/admin/assets/lead_notes', $filename);
            $lead->notes = $filename;
        }
        
        if($file=$request->file('mp3')){
            $filename = md5($file->getClientOriginalName().time()).'.'.$file->getClientOriginalExtension();
            $file->move('public/admin/assets/lead_mp3', $filename);
            $lead->mp3 = $filename;
        }

        // $lead->serial_number = $request->serial_number;
        $lead->branch_id = $request->branch;
        if(Auth::user()->hasRole('P.M')){
            $lead->PM_id = Auth::user()->id; 
        }
        $lead->PM_id = $request->PM;
        $lead->lead_asign = $request->lead_asign;
        $lead->customer_name = $request->customer_name;
        $lead->customer_number = $request->customer_number;
        $lead->status = $request->status;
        $lead->update();

        return redirect()->route('lead.index')->with('message' , 'Lead Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lead = Lead::where('id', $id)->first();
        if ($lead) {
            $lead->delete();
            return true;
        } else {
            return response()->json(['message' => 'Failed '], 404);
        }
    }

    public function getPM(Request $request)
    {
        return User::role('P.M')->where('branch_id' , $request->branch_id)->get(['id', 'name']);
    }
}
