<hr>
@if(isset($link))
    <a href="{{@$link}}">
        @endif
        <div class="media">
            <div class="media-left">

                <img class="media-object" src="{{@$image}}" alt="">

            </div>
            <div class="media-body">
                <h4 class="media-heading">{{@$heading}}</h4>
                {!! @$body !!}
            </div>
        </div>
        @if(isset($link))
    </a>
@endif
{{--<br>--}}