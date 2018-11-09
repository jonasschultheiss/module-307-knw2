<?php
/**
 * Created by PhpStorm.
 * User: quest1onmark
 * Date: 08.11.18
 * Time: 15:07
 */

// error_reporting(0);
include('request_handler.php');

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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">

    <title>module-307-knw2</title>
</head>
<body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

<div class="container-fluid">
    <div class="container shadow-lg p-3 mb-5 rounded bg-light" style="margin-top: 30px">
        <h1 style="margin-bottom: 30px">quest1onmark's extremely useful connection searcher</h1>
        <div class="col-12 shadow p-3 mb-5 bg-light rounded">
            <?php
            if (isset($response['connections'][0])) {
                echo "<h3>From " . $response['connections'][0]['from'] . " to " . $response['connections'][0]['to'] . "</h3><br><p>" . $response['description'] . "</p>";
                ?>
                <table class="table table-light">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Connection</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Departure</th>
                        <th scope="col">Arrival</th>
                    </tr>
                    </thead>
                    <?php
                    foreach ($response['connections'] as $key => $value) {
                        ?>
                        <tr class="table-secondary">
                            <th scope="row"><?php echo $key + 1; ?></th>
                            <th scope="row"><?php echo $value['from']; ?></th>
                            <th scope="row"><?php echo $value['to']; ?></th>
                            <th scope="row"><?php echo gmdate('H:i', $value['duration']); ?></th>
                            <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['departure'])); ?></th>
                            <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['arrival'])); ?></th>
                        </tr>
                        <tr>
                            <th scope="row"><?php echo $value['legs'][0]['line'] . ' / ' . $value['legs'][0]['number']; ?></th>
                            <th scope="row"><?php echo 'Gleis ' . $value['legs'][0]['track']; ?></th>
                            <th scope="row"><?php echo 'Gleis ' . $value['legs'][0]['exit']['track']; ?></th>
                            <th scope="row"></th>
                            <th scope="row"><?php if (isset($value['dep_delay'])) {
                                    echo 'Verspätung: ' . $value['dep_delay'] . ' Minuten';
                                } ?></th>
                            <th scope="row"><?php if (isset($value['arr_delay'])) {
                                    echo 'Verspätung: ' . $value['arr_delay'] . ' Minuten';
                                } ?></th>
                        </tr>
                        <?php if (isset($value['legs'][0]['stops'][0]['departure'])) { ?>
                            <tr>
                                <th scope="row"><?php echo $value['legs'][0]['line'] . ' / ' . $value['legs'][0]['number']; ?>
                                    Stoppt in <?php echo $value['legs'][0]['stops'][0]['name']; ?></th>
                                <th scope="row"><?php echo $value['legs'][0]['stops'][0]['name']; ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][1]['departure'])) {
                                        echo $value['legs'][0]['stops'][1]['name'];
                                    } else {
                                        echo $value['to'];
                                    } ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][0]['dep_delay'])) {
                                        echo 'Verspätung: ' . $value['legs'][0]['stops'][0]['dep_delay'] . ' Minuten';
                                    } ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][0]['departure'])); ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][0]['arrival'])); ?></th>
                            </tr>
                        <?php } ?>
                        <?php if (isset($value['legs'][0]['stops'][1]['departure'])) { ?>
                            <tr>
                                <th scope="row"><?php echo $value['legs'][0]['line'] . ' / ' . $value['legs'][0]['number']; ?>
                                    Stoppt in <?php echo $value['legs'][0]['stops'][1]['name']; ?></th>
                                <th scope="row"><?php echo $value['legs'][0]['stops'][1]['name']; ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][2]['departure'])) {
                                        echo $value['legs'][0]['stops'][1]['name'];
                                    } else {
                                        echo $value['to'];
                                    } ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][1]['dep_delay'])) {
                                        echo 'Verspätung: ' . $value['legs'][0]['stops'][1]['dep_delay'] . ' Minuten';
                                    } ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][1]['departure'])); ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][1]['arrival'])); ?></th>
                            </tr>
                            <?php
                        }
                        ?>
                        <?php if (isset($value['legs'][0]['stops'][2]['departure'])) { ?>
                            <tr>
                                <th scope="row"><?php echo $value['legs'][0]['line'] . ' / ' . $value['legs'][0]['number']; ?>
                                    Stoppt in <?php echo $value['legs'][0]['stops'][2]['name']; ?></th>
                                <th scope="row"><?php echo $value['legs'][0]['stops'][2]['name']; ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][3]['departure'])) {
                                        echo $value['legs'][0]['stops'][2]['name'];
                                    } else {
                                        echo $value['to'];
                                    } ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][2]['dep_delay'])) {
                                        echo 'Verspätung: ' . $value['legs'][0]['stops'][2]['dep_delay'] . ' Minuten';
                                    } ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][2]['departure'])); ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][2]['arrival'])); ?></th>
                            </tr>
                        <?php } ?>
                        <?php if (isset($value['legs'][0]['stops'][3]['departure'])) { ?>
                            <tr>
                                <th scope="row"><?php echo $value['legs'][0]['line'] . ' / ' . $value['legs'][0]['number']; ?>
                                    Stoppt in <?php echo $value['legs'][0]['stops'][3]['name']; ?></th>
                                <th scope="row"><?php echo $value['legs'][0]['stops'][3]['name']; ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][4]['departure'])) {
                                        echo $value['legs'][0]['stops'][3]['name'];
                                    } else {
                                        echo $value['to'];
                                    } ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][3]['dep_delay'])) {
                                        echo 'Verspätung: ' . $value['legs'][0]['stops'][3]['dep_delay'] . ' Minuten';
                                    } ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][3]['departure'])); ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][3]['arrival'])); ?></th>
                            </tr>
                        <?php } ?>
                        <?php if (isset($value['legs'][0]['stops'][4]['departure'])) { ?>
                            <tr>
                                <th scope="row"><?php echo $value['legs'][0]['line'] . ' / ' . $value['legs'][0]['number']; ?>
                                    Stoppt in <?php echo $value['legs'][0]['stops'][4]['name']; ?></th>
                                <th scope="row"><?php echo $value['legs'][0]['stops'][4]['name']; ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][5]['departure'])) {
                                        echo $value['legs'][0]['stops'][4]['name'];
                                    } else {
                                        echo $value['to'];
                                    } ?></th>
                                <th scope="row"><?php if (isset($value['legs'][0]['stops'][4]['dep_delay'])) {
                                        echo 'Verspätung: ' . $value['legs'][0]['stops'][4]['dep_delay'] . ' Minuten';
                                    } ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][4]['departure'])); ?></th>
                                <th scope="row"><?php echo date('H:i d-m-Y', strtotime($value['legs'][0]['stops'][4]['arrival'])); ?></th>
                            </tr>
                        <?php } ?>
                    <?php } ?>

                </table>
                <?php
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\"><h3>No Connections found.</h3><p>Make sure you entered valid information.</p></div>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>

<?php // print_r($response); ?>