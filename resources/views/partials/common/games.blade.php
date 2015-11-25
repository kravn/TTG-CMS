<div class="row">
    @foreach ($xml->menu->submenu[0]->game as $games)
        <div class="col-xs-4 col-md-2">
            <div class="game-icon">
                <a href="#">
                    <img src="https://ams-games.stg.ttms.co/player/images/games/{{ $games['id'] }}.png">
                    {{ $games['display'] }}
                </a>
            </div>
        </div>
    @endforeach
</div>

<div class="jumbotron">
    <h1>LIST OF GAMES</h1>
    <pre>
        PROMOTIONS: <br>
        {{ $promotions }}
    </pre>
    <pre>
        GAMES LIST: <br>
        {{ $xml->menu->submenu[0]->game['display'] }}
    </pre>



    <hr/>
    <div class="row"></div>
    @foreach ($xml->menu->submenu as $menu_item)
        <article class="entry-item">
            <img src="{{utf8_decode((string)$menu_item->enclosure['url'])}}" alt="">
            <div class="entry-content">
                <a href="#">
                    {{ $menu_item['name'] }}
                </a>
                {{ $menu_item->name }}
            </div>
        </article>
    @endforeach
</div>



