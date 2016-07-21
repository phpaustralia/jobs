@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Posts</h1>
            <div class="pull-right">
                <a href="/posts/create" class="btn btn-primary">Add New</a>
            </div>
        </div>
    <table class="table">
        <thead>
        <th>Title</th>
        <th>Content</th>
        <th>Posted by</th>
        <th>Created at</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->title}}</td>
                <td>{!! $post->content !!}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at}}</td>
                <td>
                    <a href="/posts/{{$post->id}}" class="btn btn-primary">view</a>
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-success">edit</a>
                    <form action="/posts/{{$post->id}}" method="post" style="display: inline;">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger" type="submit">
                            delete
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@stop