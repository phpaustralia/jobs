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
                    @foreach($jobs as $job)
                        @include('partials.media', ['heading' => $job->title, 'link' => url("/jobs/$job->id")])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
