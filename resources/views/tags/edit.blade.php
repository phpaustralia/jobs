@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <h1>Create Tag</h1>
        <div class="row">
            <div class="col-sm-6">
                <form action="/admin/tags/{{$tag->id}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{$tag->name}}" class="form-control">
                    </div>
                    <div class="form-group"><label for="description">Description</label>
                        <textarea name="description"
                                  id="" cols="30"
                                  rows="10"
                                  class="form-control"
                                    >{{$tag->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop