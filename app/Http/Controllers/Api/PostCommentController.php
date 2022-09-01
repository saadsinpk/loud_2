<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\Comment;
use App\Http\Resources\PostCommentResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostCommentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|:posts,id',
            'comment' => 'required|max:1000',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            Comment::create([
                'user_id' => JWTAuth::user()->id,
                'post_id' => $request->post_id,
                'comment' => $request->comment,
                'parent_id' => $request->parent_id,
            ]);

            return response()->json([
                        'message' => __("post_comments.created_success")
                            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function single_post_comment($id) {
        try {
            $post_comment = Comment::where('post_id', $id)->get();
            $return_array = array();
            foreach ($post_comment as $comment_key => $comment_value) {
                $return_array[] = response()->json(new PostCommentResource($comment_value));
            }
            return $return_array;
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
    public function show(PostComment $post_comment) {
        try {
            return response()->json(new PostCommentResource($post_comment));
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
            'comment' => 'required|max:1000',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            Comment::where("id",$id)->update([
                'comment' => $request->comment,
            ]);

            return response()->json([
                        'message' => __("post_comments.updated_success")
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
            Comment::where("id",$id)->delete();

            return response()->json([
                        'message' => __("post_comments.deleted_success")
                            ], Response::HTTP_NO_CONTENT);
        } catch (Exception $exc) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

}
