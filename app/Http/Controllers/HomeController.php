<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

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
            $projects = Project::where('status', true)
                ->orderBy('created_at', 'desc')->paginate(10);

            if (view()->exists('home')) {
                return view('home')->with(compact('projects'));
            }
        //return view('admin.dashboard');
        //return view('admin.dashboard');
    }
}
