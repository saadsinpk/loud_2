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

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        if($validator->fails()){
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
            return response()->json($response, 400);
        }


        if (! $token = JWTAuth::attempt($validator->validated())) {
            $message['success'] = false;
            $message['message'] = 'Invalid login';
            return response()->json($message, Response::HTTP_UNAUTHORIZED);
        }

        $user = JWTAuth::user();
        $success = 'true';
        $message['user'] = new UserResource($user);
        $message['token'] = JWTAuth::fromUser($user);

        $user_id = JWTAuth::user()->id;

        $user_data = User::where('id', $user_id)->first();

        return response()->json(compact('success', 'message'),201);
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

        return response()->json(['success' => __("auth.logged_out")], Response::HTTP_OK);
    }

    public function request_otp(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email'
        ]);

        if($validator->fails()){
            $response['success'] = false;
            if($validator->errors()->first() == 'The selected email is invalid.') {
                $response['message'] = 'Email address does not exist';
            } else {
                $response['message'] = $validator->errors()->first();
            }
            return response()->json($response, 400);
        }

        try {
            $otp = rand(pow(10, 4 - 1), pow(10, 4) - 1);

            $user = User::where('email', $request->email)->first();
            Mail::to($user)->queue(new ForgotPasswordMail($otp));
            $user->update([
                'otp' => $otp,
                'otp_sent_on' => date('Y-m-d h:i:s')
            ]);
            $response['success'] = true;
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $e) {
            $response['success'] = false;
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function verify_otp(Request $request) {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'email' => 'required|exists:users,email',
        ]);

        if($validator->fails()){
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
            return response()->json($response, 400);
        }

        try {
            $user = User::where('email', $request->email)->first();

            $to_time = time();
            $from_time = strtotime($user->otp_sent_on);

            $otp_send_time = strtotime($user->otp_sent_on);

            if ($request->otp == $user->otp AND time() - $otp_send_time < 15 * 60) {
                $token = JWTAuth::fromUser($user);
                $response['success'] = true;
                $response['token'] = $token;
                return response()->json($response, Response::HTTP_OK);
            } else {
                $response['success'] = false;
                $response['message'] = 'Invalid or Expired OTP';
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|max:16',
        ]);
        if($validator->fails()){
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
            return response()->json($response, 400);
        }
        $this->middleware('jwt.verify');
        return JWTAuth::user();



        try {
            $user = User::find(JWTAuth::user()->id);

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            Mail::to($user)->queue(new PasswordChangedMail());

            $response['success'] = true;
            $response['message'] = 'password_changed';
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

}
