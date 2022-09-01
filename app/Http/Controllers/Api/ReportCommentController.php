<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\ReportComment;
use App\Http\Resources\ReportCommentResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportCommentController extends Controller {

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
            'report_id' => 'required',
            'comment' => 'required|max:1000',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            ReportComment::create([
                'user_id' => JWTAuth::user()->id,
                'report_id' => $request->report_id,
                'comment' => $request->comment,
                'parent_id' => $request->parent_id,
            ]);

            return response()->json([
                        'message' => __("report_comments.created_success")
                            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function single_report_comment($id) {
        try {
            $report = ReportComment::where('report_id', $id)->get();
            $return_array = array();
            foreach ($report as $comment_key => $comment_value) {
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
    public function show(ReportComment $report_comment) {
        try {
            return response()->json(new ReportCommentResource($report_comment));
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
            ReportComment::where("id",$id)->update([
                'comment' => $request->comment,
            ]);

            return response()->json([
                        'message' => __("report_comments.updated_success")
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
            ReportComment::where("id",$id)->delete();

            return response()->json([
                        'message' => __("report_comments.deleted_success")
                            ], Response::HTTP_NO_CONTENT);
        } catch (Exception $exc) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

}
