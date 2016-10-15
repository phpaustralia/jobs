@extends('admin.layouts.app')

@section('content')

        <div class="row">
            <h1>Edit Role</h1>
            <div class="pull-right">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form action="/admin/roles/{{$role->id}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="title"> Name</label>
                        <input type="text" name="title" class="form-control" value="{{$role->name}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/admin/roles" class="btn btn-default">Cancel</a>
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