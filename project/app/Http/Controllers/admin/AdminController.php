<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function index()
    {
        // return 'good';
        if(Auth::check() && Auth::user()->hasRole('CEO')){
            $page_title = 'Dashboard - CEO';
            return view('admin.dashboard.dashboard' , compact('page_title'));
        }elseif(Auth::check() && Auth::user()->hasRole('P.M')){
            $page_title = 'Dashboard - P.M';
            return view('admin.dashboard.dashboard' , compact('page_title'));
        }
        elseif(Auth::check() && Auth::user()->hasRole('Senior Agent')){
            $page_title = 'Dashboard - Senior Agent';
            return view('admin.dashboard.dashboard' , compact('page_title'));
        }
        elseif(Auth::check() && Auth::user()->hasRole('Team lead')){
            $page_title = 'Dashboard - Team lead';
            return view('admin.dashboard.dashboard' , compact('page_title'));
        }
        elseif(Auth::check() && Auth::user()->hasRole('Agent')){
            $page_title = 'Dashboard - Agent';
            return view('admin.dashboard.dashboard' , compact('page_title'));
        }else{
            return 'good';
            return redirect()->route('admin');
        }
    }
    public function loginPage()
    {
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        else{
            return view('admin.login.login');
        }
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function editProfile()
    {
        return view('admin.dashboard.edit');
    }

    public function updateProfile(Request $request)
    {   
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;

        if(empty($request->name)){
            $this->validate($request, [
                'name' => 'required',
            ]);
        }

        if(isset($request->password)){
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required|same:confirm-password',
            ]);          
            
            $user->password = Hash::make($request->password);
        }

        $user->update();
        return redirect()->back()
        ->with('message','Profile updated successfully');
    }
    public function logOut()
    {
        Auth::logout();
        return redirect()->route('admin');
    }

    //Password reset
    public function forgotPassword()
    {
        $page_title = 'Forgot Password';
        return view('auth.passwords.forgot-password', compact('page_title'));
    }
    public function passwordResetLink(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('status', 1)->first();
        if(!empty($user)){
            $page_title = 'Change Password';
            do{
                $verify_token = uniqid();
            }while(User::where('verify_token', $verify_token)->first());

            $user->verify_token = $verify_token;
            $user->update();

            $details = [
                'from' => 'admin-password-reset',
                'title' => "Hello! ". $user->name,
                'body' => "You are receiving this email because we recieved a password reset request for your account.",
                'verify_token' => $user->verify_token,
            ];
           
            \Mail::to($user->email)->send(new \App\Mail\Email($details));
    
            return redirect()->route('admin.login')->with('message', 'We have emailed your password reset link!');
        }else{
            return redirect()->back()->with('error', 'Your account not found.');
        }
    }
    public function resetPassword($verify_token)
    {
        $page_title = 'Reset Password';
        return view('web-views.login.change-password', compact('page_title', 'verify_token'));
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|same:confirm-password',
        ]);

        $user = User::where('verify_token', $request->verify_token)->first();
        $user->password = Hash::make($request->password);
        $user->verify_token = null;
        $user->update();

        if($user){
            return redirect()->route('admin.login')->with('message', 'You have updated password. You can login again.');
        }else{
            return redirect()->back()->with('error', 'Something went wrong try again');
        }
    }
}
