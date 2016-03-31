<?php
$pakyu = "this is a test";

function games() {
    $url = 'https://ams-games.ttms.co/userinfo/servlet/TaskServlet?taskId=540&seq=1&formatType=xml&deviceType=web&lsdId=zero&accName=FunAcct&lang=en&playerHandle=999999';
    $getContents = file_get_contents($url);
    $simpleXml = simplexml_load_string($getContents);
    $json = json_encode($simpleXml);
    $res = json_decode($json);
    return $res;
}

/*
 *
 *  $url = 'http://us.battle.net/wow/en/feed/news';
 *  $getContents = file_get_contents($url);
 *  $simpleXml = simplexml_load_string($getContents);
 *  $json = json_encode($simpleXml);
 *  return '<pre>'.$json.'</pre>';
 *
 */