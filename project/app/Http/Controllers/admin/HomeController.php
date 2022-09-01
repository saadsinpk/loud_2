<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Team;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Package;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->hasRole('Admin')){
            $page_title = 'Dashboard - Admin';
            $total_team_members = Team::count();
            $total_categories = Category::count();
            $total_blogs = Blog::count();
            $total_services = Service::count();
            $total_testimonials = Testimonial::count();
            $total_packages = Package::count();
            return View('admin.dashboard.dashboard', compact('page_title', 'total_team_members', 'total_categories', 'total_blogs', 'total_services', 'total_testimonials', 'total_packages'));
        }elseif(Auth::check() && Auth::user()->hasRole('Candidate')){
            $page_title = 'Dashboard - Candidate';
            $blogs = Blog::orderby('id', 'desc')->take(5)->get();
            return View('web-views.dashboard.candidate', compact('page_title', 'blogs'));
        }elseif(Auth::check() && Auth::user()->hasRole('Interviewer')){
            $page_title = 'Dashboard - Interviewer';
            return View('web-views.dashboard.interviewer', compact('page_title'));
        }else{
            return redirect()->route('admin.login');
        }
    }
}
