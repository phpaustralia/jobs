@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                    @if(Auth::check() && Auth::user()->isWatching($job))
                        <a href="/jobs/{{$job->id}}/unwatch" class="btn btn-primary">un-watch</a>
                    @else
                        <a href="/jobs/{{$job->id}}/watch" class="btn btn-primary">watch</a>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$job->title}}
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <div class="pull-right">
                                Approved?
                                @include('jobs.approve', ['job' => $job])
                            </div>
                        @endif
                    </div>
                    <div class="panel-body">

                            <b>Address:
                          {{$job->address}} </b>

                        <hr>

                        {!! $job->description !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @include('comments.partial', ['job' => $job, 'comments' => $job->comments ])
            </div>
        </div>
    </div>

@stop