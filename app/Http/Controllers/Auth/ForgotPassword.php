<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetEmail;
use Carbon\Carbon;
use Hash;
use Validator;

class ForgotPassword extends Controller
{	
	public function __construct(){
		$this->middleware('guest')->except('logout');
	}


    //pass_reset_form
    public function reset_form(Request $request){
    	return view('auth.forgot-password', compact('request'));
    }

    //send reset link
    public function send_link(Request $request){
        $validations = Validator::make($request->all(),[
            'email'=>'required|string|email|max:99'
        ]);
        if ($validations->fails()) {
            return response()->json([
                "msg"=>$validations->messages("*")->first()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        
    	
    	if (!$user) {
            return response()->json([
                "msg"=>"The account not found"
            ], 422);
    	}

    	//check old old data
    	$tokenData = PasswordResetToken::where([
            'email'=>$request->email
        ])->first();

        $expire_at = Carbon::now()->addMinutes(30);
    	if ($tokenData) {
    		$tokenData->update([
    			'token'=>uniqid().uniqid().microtime(true).mt_rand(1000, 99999),
                'created_at'=>$expire_at
    		]);
    	}else{
    		//insert new
    		$tokenData = PasswordResetToken::create([
                'email'=>$request->email,
    			'token'=>uniqid().uniqid().microtime(true).mt_rand(1000, 99999),
    			'created_at'=>$expire_at,
    		]);
    	}
    	

    
        //send email
        try {
            Mail::to($request->email)->send(new PasswordResetEmail(
                $user, $tokenData
            ));
            return response()->json([
                "msg"=>"Reset link has been sent to your email & will be expire within 30 minutes. Please check your inbox to reset password."
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "msg"=>$e->getMessage()
            ], 422);
        }
    	
    }



    //reset password post
    public function reset_password(Request $request){
        $validations = Validator::make($request->all(),[
            'token'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|min:8|max:20|confirmed',
        ]);
        if ($validations->fails()) {
            return response()->json([
                "msg"=>$validations->messages("*")->first()
            ], 422);
        }

        try {
            $token = decrypt($request->token);
            $email = decrypt($request->email);
        } catch (Exception $e) {
            return response()->json([
                "msg"=>"The email or token was invalid format!"
            ], 422);
        }

        //check account is valid
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return response()->json([
                "msg"=>"The account not found"
            ], 422);
        }

    	//validate token
    	$tokenData = PasswordResetToken::where([
            "email"=>$email,
            "token"=>$token
        ])->first();

    	if (!$tokenData) {
    		return response()->json([
                "msg"=>"The token data not found"
            ], 422);
    	}



    	//check expirity
        $expire_at = date('Y-m-d H:i', strtotime($tokenData->created_at));
        $now = date('Y-m-d H:i', strtotime(Carbon::now()));
    	if ($expire_at < $now) {
    		return response()->json([
                "msg"=>"The reset token has been expired!"
            ], 422);
    	}

    	//update the password
        try {
            $user->update([
                "password"=>Hash::make($request->password)
            ]);
        
            $tokenData->update([
                "token"=>NULL
            ]);
            
            return response()->json([
                "msg"=>"The password has been reset successfully"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "msg"=>"Internal server error, please try again later"
            ], 422);
        }
    	
    }
}
