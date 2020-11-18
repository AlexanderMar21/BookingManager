<?php
include  '../Classes/Database.php';
include  '../Classes/Booking.php';
include  '../Classes/Asset.php';
include  'functions.php';

// ======     This page is executed by AJAX ==========
$booking = new Booking();
$choice = "";
$dayView = "";
$day = "";

//    Home page will have details about check ins , check outs and witch assets should be cleaned

if( isset($_POST['selectDateValue'] )){
    // we can see the data for today and the next 3 days
    $choice = test_input($_POST['selectDateValue']);
    switch ($choice){
        // values are predifined from select <options>
        case "today":
            $day = date("Y-m-d");
            $dayView = "";
            break;
        case  "tomorrow":
            $day = new DateTime('tomorrow');
            $day =  $day->format("Y-m-d");
            $dayView = $day;
            break;
        case "afterTomorrow":
            $day = new DateTime('tomorrow + 1day');
            $day =  $day->format("Y-m-d");
            $dayView = $day;
            break;
        case "afterAfterTomorrow":
            $day = new DateTime('tomorrow + 2day');
            $day =  $day->format("Y-m-d");
            $dayView = $day;
            break;
        default :
            $day = date("Y-m-d");
            break;
    }
}else {
    $day = date("Y-m-d");
}

$checkIns = $booking->getAllBookingsByCheckIn($day , $day , "");
$checkOuts = $booking->getAllBookingsByCheckOut($day , $day ,"");
$assetsCleaning = $booking->getAllBookingsCleaningDay($day , 3);


?>
<!--   Will be printed if the day we want to check is not today -->
<h5 class="text-muted" > <?php if($choice!="today") echo date("d-M-Y" , strtotime($dayView)); ?></h5>
        <!-- check - ins   -->
<h4 class="alert alert-success">Arrivals</h4>
  <table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Booking ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Persons</th>
            <th scope="col">Total Nights</th>
            <th scope="col">Check In</th>
            <th scope="col">Check Out</th>
            <th scope="col">Asset</th>
            <th scope="col">Comments</th>

        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($checkIns as $checkIn) {
        $asset = new Asset();
        $asset->asset_id = $checkIn['booking_asset_id'];
        $asset->getDb();
        echo "<tr>";
        echo "<th scope='row'>{$checkIn['booking_id']}</th>";
        echo "<td>{$checkIn['booking_guest_name']} {$checkIn['booking_guest_surname']}</td>";
        echo "<td>{$checkIn['booking_guests_number']}</td>";
        echo "<td>".dateDiffrence($checkIn['booking_check_out'],$checkIn['booking_check_in'])."</td>";
        echo "<td>".date("d-M-Y",strtotime($checkIn['booking_check_in']))."</td>";
        echo "<td>".date("d-M-Y",strtotime($checkIn['booking_check_out']))."</td>";
        echo "<td>{$asset->asset_name} - {$asset->asset_address}</td>";
        echo "<td>{$checkIn['booking_notes']}</td>";
        echo "</tr>";
    }
        ?>
    </tbody>
    </table>

        <!--   Check - Outs  -->

    <h4 class="alert alert-danger">Departures</h4>
    <table class="table table-striped">
        <thead>
        <?php ?>
        <tr>
            <th scope="col">Booking ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Persons</th>
            <th scope="col">Check In</th>
            <th scope="col">Check Out</th>
            <th scope="col">Asset</th>
            <th scope="col">Comments</th>

        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($checkOuts as $checkOut) {
            $asset = new Asset();
            $asset->asset_id = $checkOut['booking_asset_id'];
            $asset->getDb();
            echo "<tr>";
            echo "<th scope='row'>{$checkOut['booking_id']}</th>";
            echo "<td>{$checkOut['booking_guest_name']} {$checkOut['booking_guest_surname']}</td>";
            echo "<td>{$checkOut['booking_guests_number']}</td>";
            echo "<td>".date("d-M-Y",strtotime($checkOut['booking_check_in']))."</td>";
            echo "<td>".date("d-M-Y",strtotime($checkOut['booking_check_out']))."</td>";
            echo "<td>{$asset->asset_name} - {$asset->asset_address}</td>";
            echo "<td>{$checkOut['booking_notes']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

        <!--  Assets to be cleaned  -->

    <h4 class="alert alert-warning">Cleaning</h4>
    <table class="table table-striped">
        <thead>
        <?php ?>
        <tr>
            <th scope="col">Asset</th>
            <th scope="col">Full Name</th>
            <th scope="col">Persons</th>
            <th scope="col">Check In</th>
            <th scope="col">Check Out</th>
            <th scope="col">Comments</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($checkOuts as $checkOut) {
            $asset = new Asset();
            $asset->asset_id = $checkOut['booking_asset_id'];
            $asset->getDb();
            echo "<tr>";
            echo "<td>{$asset->asset_name} - {$asset->asset_address}</td>";
            echo "<td> - </td>";
            echo "<td> - </td>";
            echo "<td> - </td>";
            echo "<td> - </td>";
            echo "<td> Empty </td>";
            echo "</tr>";
        }
        foreach ($assetsCleaning as $row) {
            $asset = new Asset();
            $asset->asset_id = $row['booking_asset_id'];
            $asset->getDb();
            echo "<tr>";
            echo "<td>{$asset->asset_name} - {$asset->asset_address}</td>";
            echo "<td>{$row['booking_guest_name']} {$row['booking_guest_surname']}</td>";
            echo "<td>{$row['booking_guests_number']}</td>";
            echo "<td>".date("d-M-Y",strtotime($row['booking_check_in']))."</td>";
            echo "<td>".date("d-M-Y",strtotime($row['booking_check_out']))."</td>";
            echo "<td> Stays </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>