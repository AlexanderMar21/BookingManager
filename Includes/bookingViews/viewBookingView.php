<br>
<h1 class="alert alert-info" >View Booking</h1>

<!-- User data comes from database  -->
<form action="index.php?action=115" method="post">
    <div class="form-row">

        <div class="form-group col-md-4">
            <label for="bookingId">Booking ID</label>
            <input type="text" readonly value="<?php echo $booking->booking_id?>" class="form-control" id="bookingId" name = "bookingId"  >
        </div>

        <div class="form-group col-md-4">
            <label for="guestName">Guest Name</label>
            <input type="text" value="<?php echo $booking->booking_guest_name?>" class="form-control" id="guestName" name = "guestName" required>
        </div>

        <div class="form-group col-md-4">
            <label for="guestSurname">Guest Surname</label>
            <input type="text" value="<?php echo $booking->booking_guest_surname?>" class="form-control" id="guestSurname" name = "guestSurname"  required >
        </div>

        <div class="form-group col-md-4">
            <label for="guestNumber">Persons</label>
            <input type="text" value="<?php echo $booking->booking_guests_number ?>" min="1" max="6" class="form-control" id="guestNumber" name = "guestNumber" required>
        </div>

        <div class="form-group col-md-4">
            <label for="guestTel">Telephone Number</label>
            <input type="text" value="<?php echo $booking->guest_tel_number?>" class="form-control" id="guestTel" name = "guestTel" >
        </div>

        <div class="form-group col-md-4">
            <label for="guestEmail">Email</label>
            <input type="email" value="<?php echo $booking->guest_email?>" class="form-control" id="guestEmail" name = "guestEmail" placeholder="email">
        </div>

        <div class="form-group col-md-4">
            <label for="assetName">Asset</label>
            <select id="assetName" name= "assetName" class="form-control">
                <?php
                $asset = new Asset();
                $results = $asset->getALl();
                foreach ($results as $result){
                    if($result['asset_id']==$booking->booking_asset_id) {
                        echo "<option value ='" . $result['asset_id'] . "' selected > " . $result['asset_name'] . " - " . "({$result['asset_address']})" . "</option>";
                    } else {
                        echo "<option value ='" . $result['asset_id'] . "'> " . $result['asset_name'] . " - " . "({$result['asset_address']})" . "</option>";

                    }
                }

                ?>

            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="checkIn">Check in</label>
            <input type="date" value="<?php echo $booking->booking_check_in?>" class="form-control" id="checkIn" name = "checkIn"  >
        </div>

        <div class="form-group col-md-4">
            <label for="checkOut">Check out</label>
            <input type="date" value="<?php echo $booking->booking_check_out?>" class="form-control" id="checkOut" name = "checkOut"  >
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="totalNights">Total Nights</label>
            <div id="totalNightsDiv">
                <p type="number" class="form-control" id="totalNights" name = "totalNights" p><?php echo dateDiffrence($booking->booking_check_out,$booking->booking_check_in)?> </p>
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingCost">Total Cost</label>
            <div id ="bookingCostDiv">
                <input type="number" value="<?php echo $booking->booking_cost?>" class="form-control" id="bookingCost" name = "bookingCost" >
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingDeposit">Booking Deposit</label>
            <input type="number" value="<?php echo $booking->booking_deposit?>" class="form-control" id="bookingDeposit" name = "bookingDeposit" >
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingCommission">Booking Commission (%)</label>
            <input type="number" value="<?php echo $booking->booking_commission?>" class="form-control" id="bookingCommission" name = "bookingCommission" >
        </div>

        <div class="form-group col-md-4">
            <label for="bookingSource">Booking Source</label>
            <input type="text" value="<?php echo $booking->booking_source?>" class="form-control" id="bookingSource" name = "bookingSource" required >
        </div>

        <div class="form-group col-md-6">
            <label for="bookingNotes">Booking Comments</label>
            <textarea class="form-control" rows="1" cols="14"  id="bookingNotes" name = "bookingNotes" ><?php echo $booking->booking_notes?> </textarea>
        </div>

    </div>

    <br>
    <?php if(isset($message))echo $message;?>
    <!-- Pressing save changes will update our entry and our possible changes  -->
    <button type="submit" class="btn btn-primary" name="updateBooking" >Save Changes</button>
    <button id="deleteButton" onclick="return confirm('Are you sure?');" type="submit" name="deleteBooking" class="btn btn-warning" name="addAsset">Delete</button>
    <button type="button" class="btn btn-danger" onclick="location.href='index.php?action=112'" name="addAsset">Cancel</button>
    <br>
</form>
<br>