<?php
require '../Classes/Database.php';
require '../Classes/Booking.php';
require '../Classes/Asset.php';
require "../Functions/functions.php";

// =====     This page is executed with AJAX   ====
//  this page contains data from search results without refreshing the page using AJAX

$assetChoice = test_input($_POST['assetChoice']);
$fromDate = test_input($_POST['fromDate']);
$toDate = test_input($_POST['toDate']);

$bookings = new Booking();
// The data are coming with Jquery with post method
$results = $bookings->getAllBookingsByCheckIn($fromDate , $toDate , $assetChoice);
if(sizeof($results) > 0 ){
    foreach ($results as $row ){
        $asset = new Asset();
        $asset->asset_id = $row['booking_asset_id'];
        $asset->getDb();

        echo "<tr>";
        echo "<td><a href='index.php?action=114&bookingId={$row['booking_id']}'>".$row['booking_id']."</a></td>";
        echo "<td>".$row['booking_guest_name']." ".$row['booking_guest_surname']."</td>";
        echo "<td>".$asset->asset_name." ( ".$asset->asset_address." ) </td>";
        echo "<td>".$row['booking_guests_number']."</td>";
        echo "<td>".$row['booking_cost']." €"."</td>";
        echo "<td>".date("d-M-Y",strtotime($row['booking_check_in']))."</td>";
        echo "<td>".date("d-M-Y",strtotime($row['booking_check_out']))."</td>";
        echo "<td>".dateDiffrence($row['booking_check_out'], $row['booking_check_in'])."</td>";
        echo "</tr>";
    };
}
