<br>
<h1 class="alert alert-info" >Search Booking</h1>
<!-- Search Bookings Form -->
<form action="" method="post">
    <div class="form-row">

        <div class="form-group col-md-4">
            <label for="bookingId">Booking ID</label>
            <input type="text" class="form-control" id="bookingId" name = "bookingId" >
        </div>

        <div class="form-group col-md-4">
            <label for="guestName">Guest Name</label>
            <input type="text" class="form-control" id="guestName" name = "guestName" placeholder="name"  >
        </div>

        <div class="form-group col-md-4">
            <label for="guestSurname">Guest Surname</label>
            <input type="text" class="form-control" id="guestSurname" name = "guestSurname" placeholder="surname" >
        </div>

        <div class="form-group col-md-4">
            <label for="guestNumber">Persons</label>
            <input type="number" min="1" max="7" class="form-control" id="guestNumber" name = "guestNumber">
        </div>

        <div class="form-group col-md-4">
            <label for="guestTel">Tel. Number</label>
            <input type="text" class="form-control" id="guestTel" name = "guestTel" placeholder="telephone number">
        </div>

        <div class="form-group col-md-4">
            <label for="guestEmail">Email</label>
            <input type="email" class="form-control" id="guestEmail" name = "guestEmail" placeholder="email">
        </div>

        <div class="form-group col-md-4">
            <label for="assetName">Asset</label>
            <select id="assetName" name= "assetName" class="form-control">
                <option value="" selected> - </option>
                <?php
                $result = new Asset();
                $results = $result->getALl();
                foreach ($results as $result){
                    echo "<option value ='" .$result['asset_id']."' > ".$result['asset_name']." - "."({$result['asset_address']})"."</option>";
                }

                ?>

            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="checkInFrom">Check in from :</label>
            <input type="date" class="form-control" id="checkInFrom" name = "checkInFrom"  >
        </div>
        <div class="form-group col-md-4">
            <label for="checkInTo">Check in to :</label>
            <input type="date"  class="form-control" id="checkInTo" name = "checkInTo"  >
        </div>

        <div class="form-group col-md-4">
            <label for="checkOutFrom">Check out from :</label>
            <input type="date" class="form-control" id="checkOutFrom" name = "checkOutFrom"  >
        </div>

        <div class="form-group col-md-4">
            <label for="checkOutTo">Check out to :</label>
            <input type="date" class="form-control" id="checkOutTo" name = "checkOutTo"  >
        </div>


        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingCost">Booking Cost</label>
            <div id ="bookingCostDiv">
                <input type="text"  class="form-control" id="bookingCost" name = "bookingCost" >
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingDeposit">Booking Deposit</label>
            <input type="number"  class="form-control" id="bookingDeposit" name = "bookingDeposit" >
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingCommission">Booking Commission (%)</label>
            <input type="number"  class="form-control" id="bookingCommission" name = "bookingCommission" >
        </div>

        <div class="form-group col-md-4">
            <label for="bookingSource">Booking Source</label>
            <input type="text" class="form-control" id="bookingSource" name = "bookingSource"  >
        </div>


    </div>

    <?php // echo  $message ; ?>
    <br>
    <button type="submit" class="btn btn-primary" name="searchBooking">Search</button>
    <br>
</form>
<br>
<div>
 <?php if(isset($_POST['searchBooking'])) { ?>
     <h4 class="alert alert-success">Search Results</h4>
     <table class="table table-striped">
         <thead>
         <tr>
             <th scope="col">Booking Id</th>
             <th scope="col">Guest Full Name</th>
             <th scope="col">Persons</th>
             <th scope="col">Asset</th>
             <th scope="col">Check In</th>
             <th scope="col">Check Out</th>
             <th scope="col">Total Cost</th>



         </tr>
         </thead>
         <tbody>
         <?php
         // loop through our data
         foreach ($searchResults as $row) {
             $asset = new Asset();
             $asset->asset_id = $row['booking_asset_id'];
             $asset->getDb();
             echo "<tr>";
             echo "<td scope='row'><a href='index.php?action=114&bookingId={$row['booking_id']}'>{$row['booking_id']}</a></td>";
             echo "<td scope='row'>{$row['booking_guest_name']} {$row['booking_guest_surname']}</td>";
             echo "<td scope='row'>{$row['booking_guests_number']}</td>";
             echo "<td scope='row'>{$asset->asset_id} - {$asset->asset_name}</td>";
             echo "<td scope='row'>{$row['booking_check_in']}</td>";
             echo "<td scope='row'>{$row['booking_check_out']}</td>";
             echo "<td scope='row'>{$row['booking_cost']} €</td>";

             echo "</tr>";
         }
         ?>
         </tbody>
     </table>
<br>
    <?php } ?>
</div>
