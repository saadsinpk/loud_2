<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller {

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
            'from' => 'required',
            'email' => 'required|max:50',
            'subject' => 'required|max:100',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            ContactRequest::create([
                'from' => $request->from,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'ACTION_REQUIRED',
            ]);

            return response()->json([
                        'message' => __("contact_requests.created_success")
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
