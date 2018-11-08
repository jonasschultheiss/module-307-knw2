<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 08.11.18
 * Time: 14:06
 */


// $url = "https://fahrplan.search.ch/api/route.json?from=Therwil&to=Ettingen&num=&transportation_types=&date=&time=";


// $body = json_decode(file_get_contents($url), true);

function parse_data_to_url($from, $to, $via, $date_time_info = "", $date_time = "", $transportation_types = "")
{
    static $base_url = "https://fahrplan.search.ch/api/route.json?";
    $base_url .= "from='" . urlencode($from) . "\'&";
    $base_url .= "to='" . urlencode($to) . "\'&";
    if ($via !== "") {
        foreach ($via as $key => $value) {

        }
    }
}

function via_to_array($via = "")
{
    if ($via === "") {
        return "";
    } else {
        return explode(",", $via);
    }
}

function transportation_types_formatter($train = "", $tram = "", $bus = "", $ship = "", $cableway = "")
{
    static $final_string = "";
    $final_string .= $train !== "" ? $train . "," : "";
    $final_string .= $tram !== "" ? $tram . "," : "";
    $final_string .= $bus !== "" ? $bus . "," : "";
    $final_string .= $ship !== "" ? $ship . "," : "";
    $final_string .= $cableway !== "" ? $cableway . "," : "";

    return $final_string;
}


function GET($url)
{
    return json_decode(file_get_contents($url), true);
}

//foreach ($body['connections'] as $key => $value) {
//
//}