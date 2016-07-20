@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Jobs</h1>
            <div class="pull-right">
                <a href="/roles/create" class="btn btn-primary">Add New</a>
            </div>
        </div>
    <table class="table">
        <thead>
        <th>Name</th>
        <th>Created at</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->name}}</td>
                <td>{{$role->created_at}}</td>
                <td>
                    <a href="/roles/{{$role->id}}" class="btn btn-primary">view</a>
                    <a href="/roles/{{$role->id}}/edit" class="btn btn-success">edit</a>
                    <form action="/roles/{{$role->id}}" method="role" style="display: inline;">
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