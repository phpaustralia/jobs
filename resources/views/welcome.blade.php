@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Jobs
                    </div>
                    <div class="panel-body">
                        <joblist base_url="/api/v1/jobs" ></joblist>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
