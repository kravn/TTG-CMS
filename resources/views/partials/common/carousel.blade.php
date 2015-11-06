@if(count(Session::get('current_lang')->carousels))
    <div id="carousel-banner" class="carousel slide" data-ride="carousel">

        {!! renderCarousel('#carousel-banner', 'glyphicon glyphicon-chevron-left', 'glyphicon glyphicon-chevron-right', 'Left', 'Right') !!}

    </div>
@endif