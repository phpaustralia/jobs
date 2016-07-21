@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$job->title}}
                    </div>
                    <div class="panel-body">
                        {!! $job->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop