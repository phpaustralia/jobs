@extends('layouts.app')

@section('content')
   <div class="container">
       <div class="row">
           <h1>Create Job</h1>
       </div>
       <div class="row">
           <div class="col-sm-6">
               <form action="/posts" method="post">
                   {{ csrf_field() }}
                   <div class="form-group">
                       <label for="title"> Title</label>
                       <input type="text" name="title" class="form-control">
                   </div>
                   <div class="form-group">
                       <label for="title">Content</label>
                       <textarea  name="content" class="form-control" id="summernote" rows="18"></textarea>
                       {{--<input type="textarea" id="summernote" name="description" rows="18" class="form-control">--}}
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