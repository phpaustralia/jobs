<?php

namespace App\Http\Controllers\API\V1;

use App\Events\JobApproved;
use App\Events\JobCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Job;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class JobsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Job::where('approved', '=', 1)->orderBy('created_at')->paginate(5);
    }

    public function watching(Request $request)
    {
        if (!Auth::check()) {
            return response('Unauthorized.', 401);
        }
        return Auth::user()->watching()->paginate(5);
    }

    public function owned(Request $request)
    {
        if (!Auth::check()) {
            return response('Unauthorized.', 401);
        }
        return Auth::user()->jobs()->paginate(5);
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $latitude = $input["lat"];
        $longitude = $input["lng"];
        $radius = $input["radius"];
        $page = $request->input('page', 1);

        $jobs = Job::haversineQuery($latitude, $longitude, $radius, $page);

        return $jobs;
    }
}
