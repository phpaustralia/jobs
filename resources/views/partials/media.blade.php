<hr>
@if(isset($link))
    <a href="{{@$link}}">
        @endif
        <div class="media">
            @if( @$side != 'right')
            <div class="media-left">
                <img class="media-object" src="{{@$image}}" alt="">
            </div>
            @endif
            <div class="media-body">
                <h4 class="media-heading">{{@$heading}}</h4>
                {!! @$body !!}
            </div>
                @if( @$side == 'right')
                    <div class="media-right">

                        <img class="media-object" src="{{@$image}}" alt="">

                    </div>
                @endif
        </div>
        @if(isset($link))
    </a>
@endif
{{--<br>--}}