@extends('admin.layouts.app')

@section('content')

        <div class="row">
            <h1>Roles</h1>
            <div class="pull-right">
                <a href="/admin/roles/create" class="btn btn-primary">Add New</a>
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
                    <a href="/admin/roles/{{$role->id}}" class="btn btn-primary">view</a>
                    <a href="/admin/roles/{{$role->id}}/edit" class="btn btn-success">edit</a>
                    <form action="/admin/roles/{{$role->id}}" method="role" style="display: inline;">
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
    {{ $roles->links() }}

@stop