@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Upload File</h1>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form action="/admin/files" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop