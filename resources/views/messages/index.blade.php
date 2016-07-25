@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Conversations ({{ count($conversations) }})
                    </div>
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked">
                            @foreach($conversations as $conversation)
                                <li><a
                                            href="#{{ $conversation['id'] }}"  role="tab" data-toggle="tab"
                                    >{{ $conversation['name'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="tab-content">
                    @foreach($conversations as $conversation)
                        <div class="tab-pane" id="{{ $conversation['id'] }}">
                            <div class="panel panel-default">
                                <div class="panel-heading">Conversation</div>
                                <div class="panel-body">
                                    @foreach($conversation['messages'] as $message)
                                        @include('partials.media', [
                                       'heading' => $message->sender->name,
                                       'body' => $message->body,
                                       'image' => "https://www.gravatar.com/avatar/".md5($message->sender->email),
                                       'side' => $message->side
                                       ])
                                        <br>
                                    @endforeach
                                </div>
                            </div>

                                <form action="/messages" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="to" value="{{ $conversation['id'] }}">
                                    <div class="form-group">
                                        <label for="body"></label>
                                        <textarea  name="body" class="form-control" id="summernote" {{ Auth::check() ?: 'disabled' }} rows="6"></textarea>
                                        {{--<input type="textarea" name="body" class="form-control" id="body" >--}}
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@stop