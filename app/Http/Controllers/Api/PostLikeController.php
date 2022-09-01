<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\LikeComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostLikeController extends Controller {

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
            'status' => 'required',
            'post_id' => 'required|:posts,id',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $isLiked = LikeComment::where('post_id', $request->post_id)
                    ->where('user_id', JWTAuth::user()->id)
                    ->first();

            if ($isLiked) {
                if ($isLiked->status === $request->status) {
                    $isLiked->delete();
                } else {
                    $isLiked->update([
                        'status' => $request->status
                    ]);
                }
            } else {
                LikeComment::create([
                    'user_id' => JWTAuth::user()->id,
                    'post_id' => $request->post_id,
                    'status' => $request->status
                ]);

                if ($request->status === 'LIKE') {
                    $post = LikeComment::find($request->post_id);
                }
            }

            return response()->json([
                        'message' => __("post_likes.created_success")
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
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function single_post_like($id) {
        try {
            $post = LikeComment::where('post_id', $id)->where('status', 'LIKE')->get();
            return response()->json($post);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function single_post_dislike($id) {
        try {
            $post = LikeComment::where('post_id', $id)->where('status', 'DISLIKE')->get();
            return response()->json($post);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

}
