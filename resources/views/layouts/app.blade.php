<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PHPMelb</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">
        
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>

        <style>
            body {
                font-family: 'Lato';
            }
            .fa-btn {
                margin-right: 6px;
            }
        </style>
    </head>
    <body id="app-layout">

        @include('layouts.nav')

        <div style="min-height: 600px;">
            @yield('content')
        </div>

        @include('layouts.footer')

                <!-- JavaScripts -->
        <script src="/js/app.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
        @yield('scripts')
    </body>
</html>
