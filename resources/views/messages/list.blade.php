<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        Messages <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        @foreach($messages->take(5) as $message)
            <li><a href="{{$message->link}}">{{$message->title}}</a></li>
        @endforeach
            <li><a href="/messages">View All</a></li>
    </ul>
</li>