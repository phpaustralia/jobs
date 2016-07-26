<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jobs'] = Job::where('approved', '=', 1)->orderBy('created_at')->get();
        $data['myJobs'] = Auth::user()->jobs();
        $data['watching'] = Auth::user()->watching;

        return view('home', $data);
    }
}
