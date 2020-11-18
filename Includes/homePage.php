<?php
$bookings = new Booking();
$today = date("Y-m-d");
$checkIns = $bookings->getAllBookingsByCheckIn($today , $today , "");
$checkOuts = $bookings->getAllBookingsByCheckOut($today , $today ,"");
$assetsCleaning = $bookings->getAllBookingsCleaningDay($today , 3);
$searchResults = [];


?>
<br>
<h1 class="alert alert-info"><?php echo date("d-M-Y",strtotime($today)) ;?></h1>

<div class="home-feed">
    <div class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <label for="daySelect">Day &nbsp;</label>
            <select id="daySelect" name= "daySelect" class="form-control">
                <option value="today" selected>Today</option>
                <option value="tomorrow" >Tomorrow</option>
                <option value="afterTomorrow" >After Tomorrow</option>
                <option value="afterAfterTomorrow" >After 3 days</option>
            </select>
        </div>
    </div>
    <div id="homeTableView">
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
    </div>


    <div class="home-search">
        <br>
        <hr>
        <h4 class="bg-info text-white">Search Availability</h4>
          <div  class="form-row">
            <div class="form-group col-md-4">
              <label for="numberPersons">Persons</label>
              <select name="numberPersons" id="numberPersons" class="form-control">
                <option value="1" >1</option>
                <option value="2" selected>2</option>
                <option value="3" >3</option>
                <option value="4" >4</option>
                <option value="5" >5</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="checkIn">Check In</label>
              <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" id="checkIn" name="checkIn">
            </div>
              <div class="form-group col-md-4">
                <label for="checkOut">Check Out</label>
                <input type="date" value="<?php $datetime = new DateTime('tomorrow');
            echo $datetime->format('Y-m-d'); ?>" class="form-control" id="checkOut" name="checkOut">
              </div>

                <button style="margin:  0 auto;" id="searchAvailabilityButton" type="button" class="btn btn-primary"> Search </button>
          </div>


    </div>
    <br>
    <div id="searchResults">


    </div>
</div>
<br>
<script>

    $(document).ready( function () {

        var persons = $("#numberPersons").val();
        var checkIn = $("#checkIn").val();
        var checkOut = $("#checkOut").val();

        $("#checkIn, #checkOut").change( function () {
            checkIn = $("#checkIn").val();
            checkOut = $("#checkOut").val();

            if ( checkOut <= checkIn ){  // Check if the check out is not after the check in

                var day = new Date(checkIn);  // we retrieve the day of check in
                var nextDay = new Date(day);
                nextDay.setDate(day.getDate() + 1);
                var dd = nextDay.getDate();
                var mm = nextDay.getMonth()+1;


                var yyyy = nextDay.getFullYear();
                nextDay =  yyyy+'-'+(( mm < 10 )?"0":"" )+ mm + '-' + (( dd < 10 )?"0":"" ) + dd;

                $("#checkOut").val(nextDay);  // we set the check out date on day after the check in (1 night minimum )
        }
        })

        $("#searchAvailabilityButton").click( function () {
            persons = $("#numberPersons").val();
            checkIn = $("#checkIn").val();
            checkOut = $("#checkOut").val();

            $("#searchResults").load("Functions/searchResultsHomePage.php", {
                checkIn : checkIn,
                checkOut : checkOut,
                numberPersons : persons
            })


        })

        $("#daySelect").change( function () {
            var selectDateValue = $("#daySelect").val();

        $("#homeTableView").load("Functions/homeTasks.php", {
            selectDateValue : selectDateValue
        })
        })
    })
</script>
