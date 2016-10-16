@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <h1>{{$tag->name}}</h1>
    </div>
    <div class="row">
        <p>{{$tag->description}}</p>
    </div>
    <div class="row">
        <a href="/admin/tags/{{$tag->id}}/edit" class="btn btn-success">edit</a>
        <form action="/admin/tags/{{$tag->id}}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-danger" type="submit">delete</button>
        </form>
    </div>

@stop