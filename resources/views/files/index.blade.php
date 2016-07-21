@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Files</h1>
            <div class="pull-right">
                <a href="/files/create" class="btn btn-primary">Add New</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <th>Name</th>
            <th>Path</th>
            <th>Mimetype</th>
            <th>Size</th>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{$file->name}}</td>
                    <td>{{$file->path}}</td>
                    <td>{{$file->mimetype}}</td>
                    <td>{{$file->size}}</td>
                    <td>
                        <a href="/files/{{$file->path}}" class="btn btn-primary">view</a>
                        <form action="/files/{{$file->id}}" method="file" style="display: inline;">
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