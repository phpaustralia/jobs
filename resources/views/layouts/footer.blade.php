<div class="jumbotron" style="margin-bottom: 0;">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li><a href="/jobs">Jobs</a></li>
            @foreach(\App\PHPAustralia\Docs::all() as $doc)
                <li><a href="{{ route("docs", [$doc]) }}"> {{ strtolower($doc) }}</a></li>
            @endforeach
        </ul>
    </div>
</div>