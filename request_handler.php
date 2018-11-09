<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 08.11.18
 * Time: 14:06
 */


// $url = "https://fahrplan.search.ch/api/route.json?from=Therwil&to=Ettingen&num=&transportation_types=&date=&time=";


// $body = json_decode(file_get_contents($url), true);

function parse_data_to_url($from, $to, $via, $date_time_info = "", $date = "", $time = "", $transportation_types = "")
{
    $base_url = "https://fahrplan.search.ch/api/route.json?";
    $base_url .= "from=" . urlencode($from) . "&";
    $base_url .= "to=" . urlencode($to) . "&";
    if ($via !== "") {
        $base_url .= via_formatter($via);
    }
    if ($date_time_info === "" || $date_time_info === "depart") {
    } else {
        $base_url .= "time_type=" . urlencode($date_time_info) . "&";
    }
    if ($date === "" && $time === "") {
        $date = new DateTime();
        $date->modify("+15 minutes");
        $date = $date->format('H:i');
        $base_url .= "time=" . urlencode(date("H:i", strtotime($date))) . "&";
    } else {
        $base_url .= "date=" . urlencode("11/09/2018") . "&";
        $base_url .= "time=" . urlencode($time) . "&";
    }
    $base_url .= urlencode($transportation_types) . "&";
    $base_url .= "show_delays=1&";
    $base_url .= "num=6&";
    $base_url .= "show_trackchanges=1";

    return $base_url;
}

function via_to_array($via = "")
{
    if ($via === "") {
        return [];
    } else {
        return explode(",", $via);
    }
}

function via_formatter($via_array)
{
    $final_string = "";
    foreach ($via_array as $key => $value) {
        $value = urlencode($value);
        $final_string .= "via[]=$value&";
    }

    return $final_string;
}

function transportation_types_formatter($train = "", $tram = "", $bus = "", $ship = "", $cableway = "")
{
    $final_string = "";
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