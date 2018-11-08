<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 08.11.18
 * Time: 14:06
 */


$from = urlencode("");
$to = urlencode("");

$url = "https://fahrplan.search.ch/api/route.json?from=Therwil&to=Ettingen&num=&transportation_types=&date=&time=";

$body = json_decode(file_get_contents($url), true);

foreach ($body['connections'] as $key => $value) {

}