<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\Group;
use App\Models\GroupMembers;
use App\Models\User;
use App\Http\Resources\GroupUserCollection;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('jwt.verify');
    }
    public function index(Request $request) {
        try {
            $qry = Group::whereNotIn('id', ['0']);

            if ($request->access === "my") {
                $qry->where('user_id', $request->user('api')->id);
            }

            if ($request->q) {
                $qry->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->q . '%')->orWhere('description', 'LIKE', '%' . $request->q . '%');
                });
            }

            if ($request->sort_by === 'trending' || $request->trending) {
                $qry->orderBy('view_count', 'desc');
            } else {
                $qry->orderBy('created_at', 'desc');
            }

            if ($request->mode === 'FREE') {
                $qry->where('is_free', 'YES');
            }

            $groups = $request->limit ? new GroupCollection($qry->paginate($request->limit)) : GroupResource::collection($qry->get());

            return response()->json($groups);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function get_single($id) {
        try {
            $group = Group::where('id', $id)->first();
            $group->update([
                'view_count' => $group->view_count + 1,
            ]);
            return response()->json(new GroupResource($group));
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        try {
            $qry = Group::whereNotIn('id', ['0']);

            if ($request->keyword) {
                $qry->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->keyword . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->keyword . '%');
                });
            }

            return response()->json(GroupResource::collection($qry->get()));
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'description' => 'required',
            'access' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }
        try {
            $savepath = '';
            if($request->hasFile('media')){
                $file=$request->file('media');
                $extension=$file->getClientOriginalExtension();
                $filename="post-".rand(1,1000000).time().'.'.$extension;
                $file->move('uploads/postImages/',$filename);
                $savepath="uploads/postImages/".$filename;
            }

            Group::create([
                'user_id' => JWTAuth::user()->id,
                'name' => $request->name,
                'description' => $request->description,
                'access' => $request->access,
                'media' => $savepath,
            ]);

            if ($request->invite_peoples) {
                foreach (json_decode(json_decode($request->invite_peoples, true)) as $option) {
                    // Send Invitation Email
                }
            }


            return response()->json([
                        'message' => __("groups.created_success")
                            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group) {
        try {
            $group->update([
                'view_count' => $group->view_count + 1,
            ]);

            return response()->json(new GroupResource($group));
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'description' => 'required',
            'access' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $savepath = '';
            if($request->hasFile('media')){
                $file=$request->file('media');
                $extension=$file->getClientOriginalExtension();
                $filename="post-".rand(1,1000000).time().'.'.$extension;
                $file->move('uploads/postImages/',$filename);
                $savepath="uploads/postImages/".$filename;
                Group::where("id",$id)->update([
                    'media' => $savepath,
                ]);
            }

            Group::where("id",$id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'access' => $request->access,
            ]);

            return response()->json([
                        'message' => __("groups.updated_success")
                            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Group::where("id",$id)->delete();

            return response()->json([
                        'message' => __("groups.deleted_success")
                            ], Response::HTTP_NO_CONTENT);
        } catch (Exception $exc) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function get_all_users(Request $request, $id) {
        try {
            $group_id = $id;
            $user = GroupMembers::select("id", "member_id")->with("user")->where("group_id","=",$group_id)->get();
            // echo "<pre>";
            // print_r($user->toArray());
            // echo "</pre>";

            // exit();
            return response()->json(new GroupUserCollection($user));
        } catch (Exception $exc) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function add_user_to_group(Request $request) {
        $validator = Validator::make($request->all(), [
            'group_id' => 'required',
            'user_id' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }


        try {
            $GroupMembers = new GroupMembers();
            $GroupMembers->group_id = $request->group_id;
            $GroupMembers->member_id = $request->user_id;
            $GroupMembers->save();
        } catch (Exception $exc) {
        }
    }
    // public function test(Request $request) {
    //     // if($request->hasFile('media')){
    //     //     $file=$request->file('media');
    //     //     $extension=$file->getClientOriginalExtension();
    //     //     $filename="post-".rand(1,1000000).time().'.'.$extension;
    //     //     $file->move('uploads/postImages/',$filename);
    //     //     $savepath="uploads/postImages/".$filename;
    //     //     return $savepath;
    //     // }

    // }
}
