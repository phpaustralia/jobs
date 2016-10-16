@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <h1>Tags</h1>
        <div class="pull-right">
            <a href="/admin/tags/create" class="btn btn-primary">Add New</a>
        </div>
        </div>
    <div class="row">
        <table class="table">
            <thead>
            <th>name</th>
            </thead>
            <tbody>
            @foreach($tags as $tag)
            <tr>
                <td>{{$tag->name}}</td>
                <td>
                    <a href="/admin/tags/{{$tag->id}}" class="btn btn-primary">view</a>
                    <a href="/admin/tags/{{$tag->id}}/edit" class="btn btn-success">edit</a>
                    <form action="/admin/tags/{{$tag->id}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" type="submit">delete</button>
                    </form>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop