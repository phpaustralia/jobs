@extends('admin.layouts.app')

@section('content')
        <div class="row">
            <h1>Users</h1>
        </div>
    <table class="table">
        <thead>
        <th>Name</th>
        <th>Created at</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <a href="/users/{{$user->id}}" class="btn btn-primary">view</a>
                    <a href="/users/{{$user->id}}/edit" class="btn btn-success">edit</a>
                    <form action="/users/{{$user->id}}" method="POST" style="display: inline;">
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
    {{ $users->links() }}
@stop