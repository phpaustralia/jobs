<div class="panel panel-default">
    <div class="panel-heading">
        Comments
    </div>
    <div class="panel-body">
        <form action="/comments" method="post">
            {{csrf_field()}}
            <input type="hidden" name="job_id" value="{{$job->id}}">
            <div class="form-group">
                <label for="body"></label>
                <textarea  name="body" class="form-control" id="summernote" {{ Auth::check() ?: 'disabled' }} rows="6"></textarea>
                {{--<input type="textarea" name="body" class="form-control" id="body" >--}}
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <br><br><br>
        @foreach($comments as $comment)
            @include('partials.media', [
            'heading' => $comment->user->name,
            'body' => $comment->body,
            'image' => "https://www.gravatar.com/avatar/".md5(Auth::user()->email)
            ])
            <br>
        @endforeach
    </div>
</div>