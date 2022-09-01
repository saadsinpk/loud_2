<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class UserDeviceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'device_token' => 'required',
            'platform' => 'required',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $isExist = UserDevice::where('user_id', Auth::user()->id)
                    ->where('device_token', $request->device_token)
                    ->count();
            
            if ($isExist < 1) {
                UserDevice::create([
                    'user_id' => Auth::user()->id,
                    'device_token' => $request->device_token,
                    'platform' => $request->platform,
                    'status' => 'LOGGEDIN'
                ]);
            }

            return response()->json([
                        'message' => __("user_devices.created_success")
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

}
