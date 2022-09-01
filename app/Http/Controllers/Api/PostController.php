<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\Post;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index(Request $request) {
        try {
            $qry = Post::with("user","group")->whereNotIn('id', ['0']);

            if ($request->access === "my") {
                $qry->where('user_id', $request->user('api')->id);
            }

            if ($request->group_id) {
                $qry->where('group_id', $request->group_id);
            }

            if ($request->q) {
                $qry->where(function ($query) use ($request) {
                    $query->where('title', 'LIKE', '%' . $request->q . '%')->orWhere('description', 'LIKE', '%' . $request->q . '%');
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

            $posts = $request->limit ? new PostCollection($qry->paginate($request->limit)) : PostResource::collection($qry->get());

            return response()->json($posts);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function single_post($id) {
        try {
            $post = Post::where('id', $id)->first();
            $post->update([
                'view_count' => $post->view_count + 1,
            ]);

            return response()->json(new PostResource($post));
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
            'title' => 'required|max:100',
            'description' => 'required|max:1000',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $savepath = '';
        if($request->hasFile('media')){
            $file=$request->file('media');
            $extension=$file->getClientOriginalExtension();
            $filename="post-".rand(1,1000000).time().'.'.$extension;
            $file->move('uploads/postImages/',$filename);
            $savepath="uploads/postImages/".$filename;
        }

        try {
            Post::create([
                'user_id' => JWTAuth::user()->id,
                'group_id' => $request->group_id,
                'title' => $request->title,
                'description' => $request->description,
                'media' => $savepath,
            ]);

            return response()->json([
                        'message' => __("posts.created_success")
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
    public function show(Post $post) {
        try {
            $post->update([
                'view_count' => $post->view_count + 1,
            ]);

            return response()->json(new PostResource($post));
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
    public function update(Request $request, Post $post) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:1000',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            $savepath = '';
            if($request->hasFile('media')){
                $file=$request->file('media');
                $extension=$file->getClientOriginalExtension();
                $filename="post-".rand(1,1000000).time().'.'.$extension;
                $file->move('uploads/postImages/',$filename);
                $savepath="uploads/postImages/".$filename;
                $post->update([
                    'media' => $savepath,
                ]);
            }

            return response()->json([
                        'message' => __("posts.updated_success")
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
            Post::where("id",$id)->delete();

            return response()->json([
                        'message' => __("posts.deleted_success")
                            ], Response::HTTP_NO_CONTENT);
        } catch (Exception $exc) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function filter(Request $request) {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $qry = Post::whereNotIn('id', ['0']);

            if ($request->access === "my") {
                $qry->where('user_id', $request->user('api')->id);
            }
            $qry->whereDate('created_at','>=', $request->start_date)->whereDate('created_at','<=', $request->end_date);

            if ($request->access === "my") {
                $qry->where('user_id', $request->user('api')->id);
            }

            if ($request->group_id) {
                $qry->where('group_id', $request->group_id);
            }

            $posts = $request->limit ? new PostCollection($qry->paginate($request->limit)) : PostResource::collection($qry->get());

            return response()->json($reports);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

}
