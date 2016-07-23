@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
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
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Posts</div>

                <div class="panel-body">
                    @foreach($posts as $post)
                        @include('partials.media', ['heading' => $post->title, 'body' => $post->content, 'link' => url("/posts/$post->id")])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
