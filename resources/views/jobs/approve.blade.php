@if($job->approved)
    <b>yes</b>
    @if(Auth::check() && Auth::user()->isAdmin())
        <a href="/jobs/{{$job->id}}/approve/0" class="btn btn-success btn-xs" >
            change
        </a>
    @endif
@else
    <b>no</b>
    @if(Auth::check() && Auth::user()->isAdmin())
        <a href="/jobs/{{$job->id}}/approve/1" class="btn btn-primary btn-xs" >
            change
        </a>
    @endif
@endif