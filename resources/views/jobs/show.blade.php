@extends('layouts.app')

@section('content')

    <div class="container">

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