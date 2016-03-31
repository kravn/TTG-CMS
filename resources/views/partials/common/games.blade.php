<div class="section-divider" id="popular-games"></div>
<h1 class="section-title on-white">{{ trans('application.labels.headers.popular_games') }}</h1>

<div class="game-menu">
    <ul>
        @foreach ($xml->menu->submenu as $menu_item)
            <li>
                <a href="#" class="btn btn-danger">
                    {{ $menu_item['name'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div class="row">
    @foreach ($xml->menu->submenu[0]->game as $g)
        <div class="col-xs-4 col-md-2">
            <div class="game-icon">


                <!-- https://ams-games.ttms.co/casino/generic/game/game.html?playerHandle=999999&account=FunAcct&gameName=MonkeyAndTheMoon&gameType=0&gameId=1013&lang=en&lsdId=zero -->
                <a href="{{ $x = Config::get('components.host') . Config::get('components.game_launch') . Config::get('components.game_suffix') }}&gameName={{ $g['gameName'] }}&gameType={{ $g['type'] }}&gameId={{ $g['id'] }}" data-toggle="modal1" data-target="#AddJobModal1" target="_blank">
                    <img src="https://ams-games.stg.ttms.co/player/images/games/{{ $g['id'] }}.png">
                    {{ $g['display'] }}
                    <!-- <input type=button onClick=window.open("window-child.html","Ratting","width=550,
                         height=170,left=150,top=200,toolbar=0,status=0,"); value="Open Window">
                         Route('gamelaunch', array('host' => 'myhost', 'launch' => 'mygamelaunch'))
 -->
                </a>

            </div>
        </div>
    @endforeach
</div>




<div class="jumbotron">
    <h1>LIST OF GAMES</h1>
    <a href="{{ Route('gamelaunch', array()) }}" data-toggle="modal" data-target="#AddJobModal">This click tries to load the href into the modal</a>
    <div class="modal fade" id="AddJobModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
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

</div>
