<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('jwt.verify');
    }

    public function index(Request $request) {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show() {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function me() {
        try {
            $user = User::find(JWTAuth::user()->id);

            return response()->json(new UserResource($user));
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateMe(Request $request) {
        
      

        // if($validator->fails()){
        //         return response()->json($validator->errors()->toJson(), 400);
        // }

        try {
            $user = User::find(JWTAuth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->age = $request->age;
            $user->country = $request->country;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->lga = $request->lga;
            $user->update();
            
            // $user->update([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'gender' => $request->gender,
            //     'age' => $request->age,
            //     'country' => $request->country,
            //     'city' => $request->city,
            //     'state' => $request->state,
            //     'lga' => $request->lga,
            // ]);
            
            $savepath = '';
            if($request->hasFile('profile_picture')){
                $file=$request->file('profile_picture');
                $extension=$file->getClientOriginalExtension();
                $filename="post-".rand(1,1000000).time().'.'.$extension;
                $file->move('uploads/postImages/',$filename);
                $savepath="uploads/postImages/".$filename;
                $user->update([
                    'profile_picture' => $savepath,
                ]);
            }
        
            if(isset($request->password)) {
                // $user->update([
                //     'password' => Hash::make($request->password),
                // ]);
                $user->password = $request->password;
                $user->update();
            }
            
            $savepath = '';
            if($request->hasFile('profile_picture')){
                $file=$request->file('profile_picture');
                $extension=$file->getClientOriginalExtension();
                $filename="post-".rand(1,1000000).time().'.'.$extension;
                $file->move('uploads/postImages/',$filename);
                $savepath="uploads/postImages/".$filename;
                $user->update([
                    'profile_picture' => $savepath,
                ]);
            }
            
            return response()->json([
                        'message' => __("user.updated_success")
                            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
       
    }

}
