@extends('admin.layouts.app')

@section('content')
        <div class="row">
            <h1>Edit User</h1>
            <div class="pull-right">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form action="/admin/users/{{$user->id}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" value="{{$user->name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" value="{{$user->email}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select name="role_id" id="" class="form-control">
                            @foreach(\App\Role::all() as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/admin/users" class="btn btn-default">Cancel</a>
                    </div>
                </form>
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