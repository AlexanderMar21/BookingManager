<br>
<h1 class="alert alert-info">View Asset</h1>

<form action="" method="post">


    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="assetId">Asset ID</label>
            <input type="text" readonly value="<?php echo $asset->asset_id ?>" class="form-control" id="assetId" name = "assetId" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetName">Name</label>
            <input type="text" value="<?php echo $asset->asset_name ?>" class="form-control" id="assetName" name = "assetName" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetType">Asset Type</label>
            <select id="assetType" name= "assetType" class="form-control">
                <?php
                // here the options are hard coded for the Asset category
                // if we use those options in a database we could skip all these lines of code using a foreach loop
                if($asset->asset_type=="Entire House"){
                   echo "<option value='Entire House' selected>Entire House</option> ";
                   echo "<option value='Apartement' >Apartement</option> ";
                   echo "<option value='Shared Room' >Shared Room</option> ";
                } else if ($asset->asset_type=="Apartement") {
                   echo "<option value='Entire House' >Entire House</option> ";
                   echo "<option value='Apartement' selected>Apartement</option> ";
                   echo "<option value='Shared Room' >Shared Room</option> ";
                } else {
                    echo "<option value='Entire House' >Entire House</option> ";
                    echo "<option value='Apartement' >Apartement</option> ";
                    echo "<option value='Shared Room' selected >Shared Room</option> ";
                }

                ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="assetRooms">Total Rooms</label>
            <input type="number"  value="<?php echo $asset->asset_rooms ?>" min="0" max="4" class="form-control" id="assetRooms" name = "assetRooms" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetDoubleBeds">Total Double Beds</label>
            <input type="number" value="<?php echo $asset->asset_double_beds ?>" min="1" max="2" class="form-control" id="assetDoubleBeds" name = "assetDoubleBeds" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetSingleBeds">Total Single Beds</label>
            <input type="number" value="<?php echo $asset->asset_single_beds ?>" min="0" max="3" class="form-control" id="assetSingleBeds" name = "assetSingleBeds" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetSofaBed">Sofa Bed</label>
            <input type="number" value="<?php echo $asset->asset_sofa_bed ?>" min="0" max="2" class="form-control" id="assetSofaBed" name = "assetSofaBed" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetPersons">Total Guests Capacity</label>
            <input type="number" value="<?php echo $asset->asset_persons ?>" min="1" max="8" class="form-control" id="assetPersons" name = "assetPersons" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetAddress">Address</label>
            <input type="text" value="<?php echo $asset->asset_address ?>" class="form-control" id="assetAddress" name = "assetAddress" >
        </div>

    </div>
    <br>
    <!--  Form Buttons , 2 buttons are type submit one button is a link that redirects to viewAll Assets  -->
    <?php if(isset($statusMessage))echo $statusMessage;?>
    <button type="submit" class="btn btn-primary" <?php echo ($_SESSION['userType'] == 1)?"":"disabled"; ?> name="updateAsset" >Save Changes</button>
    <button id="deleteButton" <?php echo ($_SESSION['userType'] == 1)?"":"disabled"; ?>  onclick="return confirm('Are you sure ?');" type="submit" name="deleteAsset" class="btn btn-warning" name="addAsset">Delete</button>
    <button type="button" class="btn btn-danger" onclick="location.href='index.php?action=102'" name="addAsset">Cancel</button>
    <br>
</form>

