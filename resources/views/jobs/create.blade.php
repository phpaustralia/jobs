@extends('layouts.app')

@section('content')
   <div class="container">
       <div class="row">
           <h1>Create Job</h1>
       </div>
       <div class="row">
           <div class="col-sm-12">
               <form action="/jobs" method="post">

                   {{ csrf_field() }}
                   <input type="hidden" name="lat" value=""/>
                   <input type="hidden" name="lng" value=""/>
                   <input type="hidden" name="address" value=""/>
                   <div class="form-group">
                       <label for="pac-input">Address</label>
                       <input id="pac-input" class="controls form-control" type="text" placeholder="Search Box">
                   </div>
                   <div class="form-group">
                       <label for="title"> Title</label>
                       <input type="text" name="title" class="form-control">
                   </div>
                   <div class="form-group">
                       <label for="title">Description</label>
                       <textarea  name="description" class="form-control" id="summernote" ></textarea>
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
            $('#summernote').summernote({
                height: 300,
            });
        });

        function initAutocomplete() {

            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);

            var markers = [];

            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                places.forEach(function(place) {
                    $('input[name="lat"]').val(place.geometry.location.lat());
                    $('input[name="lng"]').val(place.geometry.location.lng());
                    $('input[name="address"]').val(place.name);
                });

            });
        }
    </script>

@endsection