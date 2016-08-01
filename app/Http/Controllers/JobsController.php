<?php

namespace App\Http\Controllers;

use App\Events\JobApproved;
use App\Events\JobCreated;
use Gate;
use App\Job;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Job::query();

        if(!Auth::check() || !Auth::user()->isAdmin()) {
            $query->where('approved', '=', 1);
        }

        $jobs = $query->paginate(10);

        return view('jobs.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

//        dd($input);

        $job = new Job();

        $job->title = $input['title'];

        $job->lat = $input['lat'];

        $job->lng = $input['lng'];

        $job->address = $input['address'];

        $job->description = $input['description'];

        $job->user_id = Auth::user()->id;

        $job->save();
        
        Event::fire(new JobCreated($job));
        
        return redirect('/jobs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);

        if ($job->approved) {
            return view('jobs.show', ['job' => $job]);
        }
        if(!Auth::check()) {
            return redirect()->guest('login');
        }
        if (Auth::id() == $job->user_id) {
            return view('jobs.show', ['job' => $job]);
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);

        if (Gate::denies('update', $job)) {
            abort(403);
        }
        
        return view('jobs.edit', ['job' => $job]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);

        if (Gate::denies('update', $job)) {
            abort(403);
        }

        $job->fill($request->all());

        $job->save();

        return redirect('/jobs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);

        if (Gate::denies('destroy', $job)) {
            abort(403);
        }

        $job->delete();

        return redirect('/jobs');
    }
    
    public function approve($id, $value)
    {
        $job = Job::find($id);

        if (Gate::denies('approve', $job)) {
            abort(403);
        }
        
        $job->approved = $value == 1 ? true : false;

        $job->save();

        Event::fire(new JobApproved($job));

        return redirect('/jobs');
    }

    public function watch($id)
    {
        $job = Job::find($id);

        Auth::user()->watching()->attach($job);

        return back();
    }

    public function unwatch($id)
    {
        $job = Job::find($id);

        Auth::user()->watching()->detach($job);

        return back();
    }
}
