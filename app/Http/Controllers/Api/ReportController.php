<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\Report;
use App\Http\Resources\ReportCollection;
use App\Http\Resources\ReportResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReportController extends Controller {

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
            $qry = Report::whereNotIn('id', ['0']);

            if ($request->access === "my") {
                $qry->where('user_id', $request->user('api')->id);
            }

            if ($request->q) {
                $qry->where(function ($query) use ($request) {
                    $query->where('title', 'LIKE', '%' . $request->q . '%');
                });
            }

            if ($request->sort_by === 'trending') {
                $qry->orderBy('view_count', 'desc');
            } else {
                $qry->orderBy('created_at', 'desc');
            }

            if ($request->mode === 'FREE') {
                $qry->where('is_free', 'YES');
            }

            $reports = $request->limit ? new ReportCollection($qry->paginate($request->limit)) : ReportResource::collection($qry->get());

            return response()->json($reports);
        } catch (Exception $e) {
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
            $qry = Report::whereNotIn('id', ['0']);

            if ($request->access === "my") {
                $qry->where('user_id', $request->user('api')->id);
            }
            $qry->whereDate('created_at','>=', $request->start_date)->whereDate('created_at','<=', $request->end_date);

            $reports = $request->limit ? new ReportCollection($qry->paginate($request->limit)) : ReportResource::collection($qry->get());

            return response()->json($reports);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function single_report($id) {
        try {
            $report = Report::where('id', $id)->first();
            $report->update([
                'view_count' => $report->view_count + 1,
            ]);
            return response()->json(new ReportResource($report));
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
            'state' => 'required',
            'lga' => 'required',
            'category' => 'required',
            'title' => 'required',
            'is_anonymous' => 'required',
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
            Report::create([
                'user_id' => JWTAuth::user()->id,
                'state' => $request->state,
                'lga' => $request->lga,
                'category' => $request->category,
                'title' => $request->title,
                'media' => $savepath,
                'message' => $request->message,
                'is_anonymous' => $request->is_anonymous,
                'status' => 'PENDING_VERIFICATION',
            ]);

            return response()->json([
                        'message' => __("reports.created_success")
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
    public function show(Report $report) {
        try {
            $report->update([
                'view_count' => $report->view_count + 1,
            ]);

            return response()->json(new ReportResource($report));
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
            'state' => 'required',
            'lga' => 'required',
            'category' => 'required',
            'title' => 'required',
            'is_anonymous' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            Report::where("id",$id)->update([
                'state' => $request->state,
                'lga' => $request->lga,
                'category' => $request->category,
                'title' => $request->title,
                'message' => $request->message,
                'is_anonymous' => $request->is_anonymous,
            ]);

            $savepath = '';
            if($request->hasFile('media')){
                $file=$request->file('media');
                $extension=$file->getClientOriginalExtension();
                $filename="post-".rand(1,1000000).time().'.'.$extension;
                $file->move('uploads/postImages/',$filename);
                $savepath="uploads/postImages/".$filename;
                Report::where("id",$id)->update([
                    'media' => $savepath,
                ]);
            }

            return response()->json([
                        'message' => __("reports.updated_success")
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
            Report::where('id',$id)->delete();

            return response()->json([
                        'message' => __("reports.deleted_success")
                            ], Response::HTTP_NO_CONTENT);
        } catch (Exception $exc) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

}
