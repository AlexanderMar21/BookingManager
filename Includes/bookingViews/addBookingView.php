<br>
<h1 class="alert alert-info" >Add New Booking</h1>

<!--   Add Booking Form -->
<form action="" method="post">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="guestName">Guest Name</label>
            <input type="text" class="form-control" id="guestName" name = "guestName" placeholder="name" required >
        </div>

        <div class="form-group col-md-4">
            <label for="guestSurname">Guest Surname</label>
            <input type="text" class="form-control" id="guestSurname" name = "guestSurname" placeholder="surname" required >
        </div>

        <div class="form-group col-md-4">
            <label for="guestNumber">Persons</label>
            <input type="number" min="1" max="6" class="form-control" id="guestNumber" name = "guestNumber" required>
        </div>

        <div class="form-group col-md-4">
            <label for="guestTel">Telephone</label>
            <input type="text" class="form-control" id="guestTel" name = "guestTel" placeholder="telephone">
        </div>

        <div class="form-group col-md-4">
            <label for="guestEmail">Email</label>
            <input type="email" class="form-control" id="guestEmail" name = "guestEmail" placeholder="email">
        </div>

        <div class="form-group col-md-4">
            <label for="assetName">Asset</label>
            <select id="assetName" name= "assetName" class="form-control">
                <?php
                    // this is dynamical
                    $asset = new Asset();
                    $results = $asset->getALl();
                    foreach ($results as $result){
                        echo "<option value ='" .$result['asset_id']."' > ".$result['asset_name']." - "."({$result['asset_address']})"."</option>";
                }

                ?>

            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="checkIn">Check in</label>
            <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" id="checkIn" name = "checkIn"  >
        </div>

        <div class="form-group col-md-4">
            <label for="checkOut">Check out</label>
            <input type="date" value="<?php $datetime = new DateTime('tomorrow');
            echo $datetime->format('Y-m-d'); ?>" class="form-control" id="checkOut" name = "checkOut"  >
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="totalNights">Total Nights</label>
            <div id="totalNightsDiv">
                <p type="number" value="" class="form-control" id="totalNights" name = "totalNights" p></p>
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingCost">Total Cost</label>
            <div id ="bookingCostDiv">
                <input type="text" value="0" class="form-control" id="bookingCost" name = "bookingCost" >
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingDeposit">Booking Deposits</label>
            <input type="number" value="0" class="form-control" id="bookingDeposit" name = "bookingDeposit" >
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="bookingCommission">Commission (%)</label>
            <input type="number" value="0" class="form-control" id="bookingCommission" name = "bookingCommission" >
        </div>

        <div class="form-group col-md-4">
            <label for="bookingSource">Booking Source</label>
            <input type="text" class="form-control" id="bookingSource" name = "bookingSource" required >
        </div>

        <div class="form-group col-md-6">
            <label for="bookingNotes">Booking Comments</label>
            <textarea class="form-control" rows="1" id="bookingNotes" name = "bookingNotes" ></textarea>
        </div>

    </div>

    <?php echo  $message ; ?>
    <button type="submit" class="btn btn-primary" name="addBooking">Add Booking</button>
    <br>
</form>
<br>

<script>

    // AJAX  FUNCTIONS
    $(document).ready( function () {

        // Load predefined prices for each  asset depending the period

        $("#assetName, #checkIn, #checkOut").change( function () {

            var assetId = $("#assetName").val();
            var checkIn = $("#checkIn").val();
            var checkOut = $("#checkOut").val();

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

            $("#bookingCostDiv").load("Functions/priceCalculation.php" , {  // Gives us the price calculated which we can also manually change
                assetId : assetId ,
                checkIn : checkIn ,
                checkOut : checkOut
            });

            $("#totalNightsDiv").load("Functions/totalNightsCalculation.php" , { // calculates the total nights
                checkIn : checkIn ,
                checkOut : checkOut
            });

        });
    });

</script>
