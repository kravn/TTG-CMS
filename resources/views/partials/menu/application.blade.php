<ul class="nav navbar-nav navbar-left">
    <li><a href="{{ action('Application\PageController@promotions') }}">{{ trans('admin.labels.navigation.promotion') }}</a></li>
    <li><a href="#popular-games">{{ trans('application.labels.headers.games') }}</a></li>
    <li><a href="#partners">{{ trans('application.labels.headers.partners') }}</a></li>
</ul>

@if(count(Session::get('current_lang')->pages))
    <ul class="nav navbar-nav">
        @foreach(Session::get('current_lang')->pages->toHierarchy() as $node)
            @if($node->is_navigation)
                {!! renderMenuNode($node) !!}
            @endif
        @endforeach
    </ul>
@endif

<ul class="nav navbar-nav navbar-right">
    <li><a href="{{ route('login') }}" targer="_blank"><i class="fa fa-user"></i> Login </a></li>
    <!--
    @if(!empty(Config::get('settings')->facebook))
        <li><a target="_blank" href="{{ Config::get('settings')->facebook }}"><i class="fa fa-facebook"></i></a></li>
    @endif
    @if(!empty(Config::get('settings')->twitter))
        <li><a target="_blank" href="{{ Config::get('settings')->twitter }}"><i class="fa fa-twitter"></i></a></li>
    @endif
    @if(!empty(Config::get('settings')->email))
        <li><a target="_blank" href="mailto:{{ Config::get('settings')->email }}"><i class="fa fa-envelope"></i></a></li>
    @endif
    -->
</ul>