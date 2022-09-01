<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\LikeComment;
use App\Models\Comment;
use App\Models\User;
use App\Models\Group;
use DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

class CommentController extends Controller
{
    function __construct()
    {
    }
    //

    public function dashboard() {
        return view("dashboard");
    }

    public function index($id) {
        $users = User::role('user')->orderBy("created_at", "DESC")->get();
        $groups = DB::table('groups')->get();
        $posts = LikeComment::where("post_id","=",$id)->orderBy("created_at", "DESC")->get();
        if (request()->ajax()) {
            return DataTables::of($posts)
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
            ->addColumn('user_id', function ($data) {
                    $checkbox2 = User::where("id","=",$data->user_id)->first()->name;
                    return $checkbox2;
                })
            ->addColumn('group_id', function ($data) {
                    $checkbox3 = Group::where("id","=",$data->group_id)->first()->name;
                    return $checkbox3;
                })
            ->addColumn('total_comment', function ($row) { 
                $comment = count($row->comment);
                return $comment;
            })
            ->addColumn('total_like', function ($row) { 
                $like = count($row->like);
                return $like;
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
                                <a href="'.url("/post/view/$data->id").'" class="menu-link px-3">Edit</a>
                            </div>';

                $action .= '<div class="menu-item px-3">
                                <a href="'.url("/post/viewComments/$data->id").'" class="menu-link px-3">View</a>
                            </div>';            


                $action .= '<div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-table-filter="delete_row">Delete</a>
                             </div>';


                $action .= "</div>";

                return $action;
            })

            ->rawColumns(['checkbox','checkbox2','checkbox3', 'group', 'action', 'created_at'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view("post.index", compact("posts","users","groups","id"));
    }


    public function store(Request $request) {
         
        $post=new Post;

        $post->title       = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->group_id = $request->group_id;

        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".time().'.'.$extension;
            $file->move('uploads/postImages/',$filename);

            $post->media=$filename;
        }

        $post->save();
        return response()->json(['msg'=>"Discussion created successfully"], 200);


        
    }

    public function destroy ($id) {
        $post = Post::find($id);
        $post->delete();

        LikeComment::where("post_id","=",$id)->delete();
        Comment::where("post_id","=",$id)->delete();

        return response()->json('200');
    }

    public function destroyRows(Request $request) {
        $posts = Post::whereIn("id", explode(",", $request->ids))->get();
        foreach ($posts as $post) {
            LikeComment::where("post_id","=",$post->id)->delete();
            Comment::where("post_id","=",$post->id)->delete();
        }
        Post::whereIn("id", explode(",", $request->ids))->delete();
        return response()->json('200');
    }

    public function details($id) {
        $post = Post::find($id);
        $users = User::role('user')->orderBy("created_at", "DESC")->get();
        $groups = DB::table('groups')->get();
        $userName = User::where("id","=",$post->user_id)->first()->name;
        $groupName = Group::where("id","=",$post->group_id)->first()->name;
        $total_like = LikeComment::where("post_id","=",$post->id)->count();
        $total_comment = Comment::where("post_id","=",$post->id)->count();
        if (!$post) {
            return abort(404);
        }

        return view("post.details", compact("post","total_like","total_comment","users","userName","groups","groupName"));
    }

    public function alldetails($id) {
        $users = User::role('user')->orderBy("created_at", "DESC")->get();


        return view("post.postDetails", compact("users","id"));
    }

    public function update(Request $request) {
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->group_id = $request->group_id;
        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".time().'.'.$extension;
            $file->move('uploads/postImages/',$filename);

            $post->media=$filename;
        }

        if (!$post->save()) {
            return  response()->json(['msg'=>"Something went wrong, please try again later."], 422);
        }


        return back()->withInput();

    }

}
