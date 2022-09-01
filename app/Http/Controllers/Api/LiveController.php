<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\Live;
use App\Http\Resources\LiveCollection;
use App\Http\Resources\LiveResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Willywes\AgoraSDK\RtcTokenBuilder;

class LiveController extends Controller {

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
            $qry = Live::orderBy('created_at', 'desc');

            if ($request->access === "my") {
                $qry->where('user_id', $request->user('api')->id);
            }

            if ($request->keyword) {
                $qry->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->keyword . '%');
                });
            }

            $lives = $request->limit ? new LiveCollection($qry->paginate($request->limit)) : LiveResource::collection($qry->get());

            return response()->json($lives);
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
            
            Live::create([
                'user_id' => JWTAuth::user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'media' => $savepath,
            ]);

            return response()->json([
                        'message' => __("lives.created_success")
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
        try {
            $live = Live::orderBy('created_at', 'desc')->where("id","=",$id)->first();
            return response()->json(new LiveResource($live));
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
            'title' => 'required|max:100',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            Live::where("id","=",$id)->update([
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
                Live::where("id","=",$id)->update([
                    'media' => $request->media,
                ]);
            }
            
            return response()->json([
                        'message' => __("lives.updated_success")
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
            live::where("id","=",$id)->delete();

            return response()->json([
                        'message' => __("lives.deleted_success")
                            ], Response::HTTP_NO_CONTENT);
        } catch (Exception $exc) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function create_agora(Request $request) {
        $validator = Validator::make($request->all(), [
            'channelName' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $appID = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');

        $channelName = $request->channelName;
        $user = JWTAuth::user()->id;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $rtcToken = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);
        return response()->json(array("success"=>$rtcToken));
    }
}
