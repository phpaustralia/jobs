@extends('layouts.app')

@section('content')
    <div id="spark-terms-screen" class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $page }}
                    </div>

                    <div class="panel-body" style="font-size: 16px">
                        {!! $content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
