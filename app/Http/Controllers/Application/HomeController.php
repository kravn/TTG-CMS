<?php

namespace App\Http\Controllers\Application;

use App\Article;
use App\Http\Controllers\Controller;

use App\Language;
use App\Promotion;
use App\User;
use Response;
use SimpleXMLElement;


class HomeController extends Controller
{
    /**
     * Show the application homepage to the user.
     *
     * @return Response
     */
    public function index()
    {
        $url = file_get_contents('https://ams-games.ttms.co/userinfo/servlet/TaskServlet?taskId=540&seq=1&formatType=xml&deviceType=web&lsdId=zero&accName=FunAcct&lang=en&playerHandle=999999');
        //$url = file_get_contents('http://rss.leparisien.fr/leparisien/rss/paris-75.xml');

        $xml = new SimpleXMLElement($url);
        //dd($xml);
        $games = json_encode($xml);

        $promotions = Promotion::all();

        $articles = $this->language->articles()->published()->orderBy('published_at','desc')->paginate(5);

        return view('application.home.index', compact('articles', 'promotions', 'xml'));

    }
}