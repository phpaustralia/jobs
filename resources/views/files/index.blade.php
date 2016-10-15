@extends('admin.layouts.app')

@section('content')

        <div class="row">
            <h1>Files</h1>
            <div class="pull-right">
                <a href="/admin/files/create" class="btn btn-primary">Add New</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <th>Name</th>
            <th>URL</th>
            <th>Mimetype</th>
            <th>Size</th>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <td>{{ str_limit($file->name, 20) }}</td>
                    <td>{{ url("/files/$file->path") }}</td>
                    <td>{{$file->mimetype}}</td>
                    <td>{{$file->size}}</td>
                    <td>
                        <a href="/admin/files/{{$file->path}}" class="btn btn-primary">view</a>
                        <form action="/admin/files/{{$file->id}}" method="post" style="display: inline;">
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
        {{ $files->links() }}

@stop