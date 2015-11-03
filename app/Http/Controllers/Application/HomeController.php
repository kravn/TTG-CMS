<?php

namespace App\Http\Controllers\Application;

use App\Article;
use App\Http\Controllers\Controller;

use App\Language;
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
        $xml = file_get_contents('https://ams-games.stg.ttms.co/userinfo/servlet/TaskServlet?taskId=540&seq=1&formatType=xml&deviceType=web&lsdId=zero&accName=FunAcct&lang=en&playerHandle=999999');
        //$xml = file_get_contents('http://cloud.tfl.gov.uk/TrackerNet/PredictionSummary/V');

        $xml = new SimpleXMLElement($xml, LIBXML_PARSEHUGE);
        $json = json_encode($xml);
        $games = json_decode($xml);
        $articles = $this->language->articles()->published()->orderBy('published_at','desc')->paginate(5);

        return view('application.home.index', compact('articles', 'games', 'xml'));

    }
}