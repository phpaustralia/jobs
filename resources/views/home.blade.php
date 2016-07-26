@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Jobs
                    <div class="pull-right">
                        <a href="/jobs/create" class="btn btn-sm btn-primary" >Add New</a>
                    </div>
                </div>

                <div class="panel-body">
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#all-jobs" aria-controls="all-jobs" role="tab" data-toggle="tab">All</a></li>
                            <li role="presentation"><a href="#my-jobs" aria-controls="my-jobs" role="tab" data-toggle="tab">My Jobs</a></li>
                            <li role="presentation"><a href="#watching-jobs" aria-controls="watching-jobs" role="tab" data-toggle="tab">Watching</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="all-jobs">
                                @foreach($jobs as $job)
                                    @include('partials.media', ['heading' => $job->title, 'link' => url("/jobs/$job->id")])
                                @endforeach
                            </div>
                            <div role="tabpanel" class="tab-pane" id="my-jobs">
                                @foreach($myJobs as $job)
                                    @include('partials.media', ['heading' => $job->title, 'link' => url("/jobs/$job->id")])
                                @endforeach
                            </div>
                            <div role="tabpanel" class="tab-pane" id="watching-jobs">
                                @foreach($watching as $job)
                                    @include('partials.media', ['heading' => $job->title, 'link' => url("/jobs/$job->id")])
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
