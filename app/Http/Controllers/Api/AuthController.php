<?php

namespace App\Http\Controllers\Api;

use Mail;
use Validator;
use JWTAuth;
use App\Models\User;
use App\Models\UserDevice;
use App\Http\Resources\UserResource;
use App\Mail\ForgotPasswordMail;
use App\Mail\PasswordChangedMail;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;

class AuthController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        // exit();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users|max:256',
            'password' => 'required|min:8|max:16|confirmed',
            'gender' => 'required',
            'age' => 'required|numeric',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {

            $savepath = '';
            if($request->hasFile('profile_picture')){
                $file=$request->file('profile_picture');
                $extension=$file->getClientOriginalExtension();
                $filename="post-".rand(1,1000000).time().'.'.$extension;
                $file->move('uploads/postImages/',$filename);
                $savepath="uploads/postImages/".$filename;
            }

            $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'gender' => $request->gender,
                        'age' => $request->age,
                        'platform' => $request->platform,
                        'profile_picture'=>$savepath,
            ]);
            $user->assignRole('user');

            Mail::to($user)->queue(new WelcomeMail());

            return response()->json([
                        'message' => __("auth.registration_success")
                            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function social(Request $request) {
        $validator = Validator::make($request->all(), [
            'provider' => 'required',
            'provider_id' => 'required'
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        if($request->provider == 'Apple') {

            try {
                $user = User::where('provider_id', $request->provider_id)->first();
                if(empty($user)) {
                    $user = User::create([
                                'name' => $request->name,
                                'email' => $request->email,
                                'gender' => $request->gender,
                                'age' => $request->age,
                                'password' => Hash::make(time()),
                                'platform' => $request->platform,
                                'provider' => $request->provider,
                                'provider_id' => $request->provider_id
                    ]);
                    $user->assignRole('user');
                    Mail::to($user)->queue(new WelcomeMail());
                } else {
                    $user = User::where('provider_id', $request->provider_id)->first();
                }
                $user->update([
                    'firebase_token' => $request->firebase_token
                ]);

                $token = JWTAuth::fromUser($user);
                return response()->json(compact('token'),201);
            } catch (Exception $e) {
                return response()->json([
                            'message' => $e->getMessage()
                                ], Response::HTTP_BAD_REQUEST);
            }

        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:30',
                'email' => 'required|email|max:256',
                'gender' => 'required',
                'age' => 'required|numeric',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            try {
                $user = User::where('email', $request->email)->first();
                if(empty($user)) {
                    $user = User::create([
                                'name' => $request->name,
                                'email' => $request->email,
                                'gender' => $request->gender,
                                'age' => $request->age,
                                'password' => Hash::make(time()),
                                'platform' => $request->platform,
                                'provider' => $request->provider,
                                'provider_id' => $request->provider_id
                    ]);
                    $user->assignRole('user');
                    Mail::to($user)->queue(new WelcomeMail());
                } else {
                    $user = User::where('email', $request->email)->where('provider_id', '=', $request->provider_id)->first();
                }
                $user->update([
                    'firebase_token' => $request->firebase_token
                ]);

                $token = JWTAuth::fromUser($user);
                return response()->json(compact('token'),201);
            } catch (Exception $e) {
                return response()->json([
                            'message' => $e->getMessage()
                                ], Response::HTTP_BAD_REQUEST);
            }

        }

    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }


        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json([
                        'message' => __("auth.invalid_login")
                            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = JWTAuth::user();
        $success = 'true';
        $message = "We're glad to see you back on Loud9ja,Anna Kude";
        $data = array(new UserResource($user));
        $meta = 'valid';
        $token = JWTAuth::fromUser($user);

        $user_id = JWTAuth::user()->id;

        $user_data = User::where('id', $user_id)->first();

        if(isset($request->firebase_token)) {
            $user_data->update([
                'firebase_token' => $request->firebase_token
            ]);
        }

        // if(!JWTAuth::user()->hasRole('user')) {
        //     return response()->json([
        //                 'message' => __("auth.invalid_login")
        //                     ], Response::HTTP_UNAUTHORIZED);
        // }
        return response()->json(compact('success', 'message', 'data', 'meta','token'),201);
    }

    public function logout(Request $request) {
        // if ($request->device_token) {
            // $userDevice = UserDevice::where('user_id', Auth::user()->id)
            //         ->where('device_token', $request->device_token)
            //         ->first();
            // if ($userDevice) {
            //     $userDevice->update([
            //         'status' => 'LOGGEDOUT'
            //     ]);
            // }
        // }

        // Auth::guard('api')->user()->token()->revoke();
        $user_data = User::where('id', JWTAuth::user()->id)
                ->first();

        $user_data->update([
            'firebase_token' => ''
        ]);

        return response()->json(['success' => __("auth.logged_out")], Response::HTTP_OK);
    }

    public function forgotPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email'
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $otp = rand(pow(10, 4 - 1), pow(10, 4) - 1);

            $user = User::where('email', $request->email)->first();
            Mail::to($user)->queue(new ForgotPasswordMail($otp));
            $user->update([
                'otp' => $otp,
                'otp_sent_on' => date('Y-m-d h:i:s')
            ]);

            return response()->json([
                        'message' => __("auth.otp_sent")
                            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8|max:16|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            $user = User::where('email', $request->email)->first();

            $to_time = time();
            $from_time = strtotime($user->otp_sent_on);

            if ($request->otp == $user->otp) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                Mail::to($user)->queue(new PasswordChangedMail());

                return response()->json([
                            'message' => __("auth.password_changed")
                                ], Response::HTTP_OK);
            } else {
                return response()->json([
                            'message' => __("auth.invalid_otp")
                                ], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $e) {
            return response()->json([
                        'message' => $e->getMessage()
                            ], Response::HTTP_BAD_REQUEST);
        }
    }

}
