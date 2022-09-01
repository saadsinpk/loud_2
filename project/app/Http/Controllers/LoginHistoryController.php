<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role as UserRole;
use Spatie\Permission\Models\Role;
use Auth;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{


    public function index(Request $request){
        $clientIP = $request->getClientIp();    
        return $clientIP;
        $page_title = 'All History';
        $users=User::orderby('id' , 'desc')->where('id' ,'!=' , Auth::user()->id)->paginate(10);
        return view('admin.loginhistory.index' , compact('users','page_title'));
    }
}
