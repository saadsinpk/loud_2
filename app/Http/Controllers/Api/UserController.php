<?php

namespace App\Http\Controllers\Api;

use Mail;
use JWTAuth;
use Validator;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Mail\PasswordChangedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|max:16',
        ]);
        if($validator->fails()){
            $response['success'] = false;
            $response['message'] = $validator->errors()->first();
            return response()->json($response, 400);
        }

        try {
            $user = User::find(JWTAuth::user()->id);

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            Mail::to($user)->queue(new PasswordChangedMail());

            $response['success'] = true;
            $response['message'] = 'auth.password_changed';
            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }
}