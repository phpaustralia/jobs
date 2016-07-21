@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Jobs</h1>
            <div class="pull-right">
                <a href="/jobs/create" class="btn btn-primary">Add New</a>
            </div>
        </div>
    <table class="table">
        <thead>
        <th>Title</th>
        <th>Description</th>
        <th>Posted by</th>
        <th>Created at</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <td>{{$job->title}}</td>
                <td>{!! $job->description !!}</td>
                <td>{{$job->user->name}}</td>
                <td>{{$job->created_at}}</td>
                <td>
                    <a href="/jobs/{{$job->id}}" class="btn btn-primary">view</a>
                    <a href="/jobs/{{$job->id}}/approve" class="btn btn-success" >Approve</a>
                    <a href="/jobs/{{$job->id}}/edit" class="btn btn-warning">edit</a>
                    <form action="/jobs/{{$job->id}}" method="post" style="display: inline;">
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