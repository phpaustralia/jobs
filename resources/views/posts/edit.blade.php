@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Post</h1>
            <div class="pull-right">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form action="/posts/{{$post->id}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="title"> Title</label>
                        <input type="text" name="title" class="form-control" value="{{$post->title}}">
                    </div>
                    <div class="form-group">
                        <label for="title">Content</label>
                        <textarea  name="content" class="form-control" id="summernote" rows="18" value="{{$post->content}}"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/posts" class="btn btn-default">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });

    </script>
@stop