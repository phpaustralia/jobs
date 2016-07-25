<?php

namespace App\Http\Controllers;

use App\Job;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function welcome()
    {
        $jobs = Job::where('approved', '=', 1)->orderBy('created_at')->get();

        return view('welcome', ['jobs' => $jobs]);
    }
}
