<nav class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <div class="inside">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{  route('root') }}">
                    <img src="{{ response()->logo() }}" alt=""/>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                @include('partials.menu.application')
            </div>
        </div>
    </div>
</nav>