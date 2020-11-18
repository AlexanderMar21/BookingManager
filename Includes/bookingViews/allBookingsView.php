<br>
<h1 class="alert alert-primary">All Bookings</h1>
<!--    View All Bookings   -->
<div class="form-inline">
    <div class="form-group mx-sm-3 mb-2">
        <label for="assetId">Asset &nbsp;</label>
        <select id="assetId" name= "assetId" class="form-control">
            <option value="" selected>All</option>
            <?php
                    $assets = new Asset();
                    $assetsResult = $assets->getAll();
                    foreach ( $assetsResult as $asset ){
                        echo "<option value='{$asset['asset_id']}'>{$asset['asset_id']} - {$asset['asset_name']}</option>";
                    }
            ?>
        </select>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="fromDate">From &nbsp;</label>
        <input type="date" value="<?php echo date("Y-m-d");?>" class="form-control" id="fromDate" name = "fromDate"  >
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="toDate">Till &nbsp;</label>
        <input type="date" value="" class="form-control" id="toDate" name = "toDate"  >
    </div>
    <button id="viewButton" type="button" class="btn btn-primary mb-2">Show</button>
</div>

<h5 class="alert alert-success">All Results</h5>

<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Booking ID</th>
        <th scope="col">Full Name</th>
        <th scope="col">Asset</th>
        <th scope="col">Perons</th>
        <th scope="col">Cost</th>
        <th scope="col">Check In</th>
        <th scope="col">Check Out</th>
        <th scope="col">Total Nights</th>
    </tr>
    </thead>
    <tbody id= "results">
    <?php
    // The bookings when the pages load are the upcoming booking from today and after
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
    ?>
    </tbody>
</table>

<script>

    // ===== AJAX  FUNCTIONS  ===//
    $(document).ready( function () {


        // When we click the button new results will be shown without refreshing
        $("#viewButton").click( function () {

            var assetChoice = $("#assetId").val();
            var fromDate = $("#fromDate").val();
            var toDate = $("#toDate").val();

            // send our data with post method to be proscessed
            $("#results").load("Functions/bookingsComplexView.php" ,{
                assetChoice : assetChoice,
                fromDate : fromDate,
                toDate : toDate
            } )

        });
    });

</script>
