<?php

namespace App\Http\Controllers;

use App\Models\PoliticalPartyAgent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $list = array();
        return view("web.home", compact("list"));
    }

    public function agentProfile(Request $request,$slug)
    {
        $agent = PoliticalPartyAgent::where('slug',$slug)->first();
        return view("web.agentProfile", compact("agent"));
    }

}
