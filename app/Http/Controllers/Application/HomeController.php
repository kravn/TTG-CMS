<?php

namespace App\Http\Controllers\Application;

use App\Article;
use App\Http\Controllers\Controller;
use App\Language;
use App\Promotion;
use App\User;
use Illuminate\Support\Facades\Config;
use Response;
use SimpleXMLElement;
use App\Providers\GeneralServiceProvider;


class HomeController extends Controller
{

    public function index3(){
        $res = Language::all();
        $res1 = Response::make(Language::all(), '200')->header('Content-Type', 'text/xml');

        //dd($res);
        return view('application.home.test', compact('res'));
    }

    public function index5()
    {
        //$res = $this->game_list(Config::get('components.xml'));
        return view('application.home.test');
    }
    /**
     * Show the application homepage to the user.
     *
     * @return Response
     */
    public function index()
    {
        $url = Config::get('components.xml');
        //$url = file_get_contents('http://rss.leparisien.fr/leparisien/rss/paris-75.xml');
        $xml = new SimpleXMLElement($url);
        $array=json_encode(simplexml_load_string(Config::get('components.xml')));
        //dd($array);
        $games = json_encode($xml);

//        $url = "https://ams-games.ttms.co/userinfo/servlet/TaskServlet?taskId=540&seq=1&formatType=xml&deviceType=mobile&lsdId=zero&accName=FunAcct&lang=en&playerHandle=999999";
//        //$url = "http://us.battle.net/wow/en/feed/news";
//        $getContents = file_get_contents($url);
//        $simpleXml = simplexml_load_string($getContents);
//        $json = json_encode($simpleXml);
//        $xml = json_decode($json);



        $promotions = Promotion::all();

        $articles = $this->language->articles()->published()->orderBy('published_at','desc')->paginate(5);

        return view('application.home.index', compact('articles', 'promotions', 'xml'));

    }

    public function topgames(){
        $url = file_get_contents('https://ams-games.ttms.co/userinfo/servlet/TaskServlet?taskId=540&seq=1&formatType=xml&deviceType=web&lsdId=zero&accName=FunAcct&lang=en&playerHandle=999999');
        //$url = file_get_contents('http://rss.leparisien.fr/leparisien/rss/paris-75.xml');

        $xml = new SimpleXMLElement($url);
        //dd($xml);
        $games = json_encode($xml);

        $promotions = Promotion::all();

        $articles = $this->language->articles()->published()->orderBy('published_at','desc')->paginate(5);

        return view('application.home.index', compact('articles', 'promotions', 'xml'));
    }

    public function runJson(){
        $url = "https://ams-games.ttms.co/userinfo/servlet/TaskServlet?taskId=540&seq=1&formatType=xml&deviceType=mobile&lsdId=zero&accName=FunAcct&lang=en&playerHandle=999999";
        $url = "http://us.battle.net/wow/en/feed/news";
        $getContents = file_get_contents($url);
        $simpleXml = simplexml_load_string($getContents);
        $json = json_encode($simpleXml);
        $res = json_decode($json);
        return $res;
    }

    public function gamelaunch($host, $launch){
        return Route('root');
    }

}
