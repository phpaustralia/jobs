@extends('admin.layouts.app')

@section('content')
   <div class="container">
       <div class="row">
           <h1>Create Role</h1>
       </div>
       <div class="row">
           <div class="col-sm-6">
               <form action="/admin/roles" method="post">
                   {{ csrf_field() }}
                   <div class="form-group">
                       <label for="name">Name</label>
                       <input type="text" name="name" class="form-control">
                   </div>
                   <div class="form-group">
                       <button type="submit">create</button>
                   </div>
               </form>
           </div>
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