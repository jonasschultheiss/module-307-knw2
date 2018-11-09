<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 08.11.18
 * Time: 15:07
 */

// error_reporting(0);
include('request_handler.php');
echo parse_data_to_url(
    $_POST['from'],
    $_POST['to'],
    via_to_array($_POST['via']),
    $_POST['date_time_info'],
    $_POST['date'],
    $_POST['time'],
    transportation_types_formatter($_POST['train'], $_POST['tram'], $_POST['bus'], $_POST['ship'], $_POST['cableway'])
);
$response = GET(
    parse_data_to_url(
        $_POST['from'],
        $_POST['to'],
        via_to_array($_POST['via']),
        $_POST['date_time_info'],
        $_POST['date'],
        $_POST['time'],
        transportation_types_formatter($_POST['train'], $_POST['tram'], $_POST['bus'], $_POST['ship'], $_POST['cableway'])
    )
);
print_r($response);