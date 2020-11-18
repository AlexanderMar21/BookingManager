<?php
/**
 * Created by PhpStorm.
 * User: alexandermargjoni
 * Date: 10/30/20
 * Time: 17:37
 */

require '../Classes/Database.php';
require "../Functions/functions.php";

//  ===== This page is executed with AJAX  =====

$asset_id = $_POST["assetId"];
$check_in = $_POST["checkIn"];
$check_out = $_POST['checkOut'];
// the total stay
$totalDays = dateDiffrence( $check_out , $check_in) ;

if( $totalDays > 0 ) {

    $DB = new Database();
    $DB->connect();

    // a booking could intersect 2 different booking periods with different price
    // Search in which pricing period is the chceck in
    $sql = " SELECT `price` , `start_period`, `end_period` FROM `prices` WHERE asset_id = ? and `start_period` <= ? and end_period >= ? LIMIT 1";
    $res = $DB->execute($sql, [$asset_id, $check_in, $check_in]);
    $row = $res->fetch();
    $price = floatval($row['price']);
    // Search in which pricing period is the chceck out
    $sql1 = " SELECT `price` , `start_period`, `end_period` FROM `prices` WHERE asset_id = ? and `start_period` <= ? and end_period >= ? LIMIT 1";
    $res1 = $DB->execute($sql1, [$asset_id, $check_out, $check_out]);
    $row1 = $res1->fetch();
    $price1 = floatval($row1['price']);

    // if dont exist predifined costs for that booking period then 0 will be returned . User will be able to change the number
    if ($res->rowCount() == 0 || $res1->rowCount() == 0) {

        echo "<input type='number' value='0' class='form-control' id='bookingCost' name = 'bookingCost' >";
    //   if the check in and check out belong to same period
    } else if ($row['start_period'] == $row1['start_period']) {
        // calculate the total cost ( days * price-per-night )
        $totalCost = $totalDays * $row['price'];
        echo "<input type='number' value='{$totalCost}' class='form-control' id='bookingCost' name = 'bookingCost' >";

    } else {
        // if the booking period is in two different price periods we calculate the days for the fist period
        $firstPeriod = dateDiffrence($row['end_period'], $check_in);
        if ($firstPeriod == 0) {  // if period ends on 30 and check in at same day then it will be calculated for 1 night
            $firstTotalCost = $price;
            $firstPeriod = 1;  // first period has one night
        } else $firstTotalCost = (++$firstPeriod ) * $price; // ++$firstPerdiod to add also the night when the period ends

        $secondPeriod = dateDiffrence($check_out, $row1['start_period']); // calculate the total days from second period

        if ($secondPeriod == 0) {  // if check out day is just on the beginning of the price period then we calculate for 0
            $secondTotalCost = 0;
        } else if ($secondPeriod > 0) $secondTotalCost = $secondPeriod * $price1; // else calculate the difference

        $totalCost = $firstTotalCost + $secondTotalCost;  // sum costs

        // if the are no gaps between periods ex. '24/5 - 27/5  and 28/5 - 30/5'
        if ($totalDays = ($firstPeriod + $secondPeriod)) {
            echo "<input type='number' value='{$totalCost}' class='form-control' id='bookingCost' name = 'bookingCost' >";

            // == if there is gap between 2 price periods  ex. '21/5 - 23/5  and 28/5 - 30/5' (there is a gap of 5 days)
            // then then gap difference will be calculated on the highest price from the  other 2 periods
        } else {
            $difference = $totalDays - ($firstPeriod - $secondPeriod);
            $extraCost = ($price1 > $price) ? ($difference * $price1) : ($difference * $price);
            echo "<input type='number' value='" . ($totalCost + $extraCost) . "' class='form-control' id='bookingCost' name = 'bookingCost' >";
        }
    }

} else {
    echo "<input type='number' value='0' class='form-control' id='bookingCost' name = 'bookingCost' >";
}

