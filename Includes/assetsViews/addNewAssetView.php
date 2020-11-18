<br>
<h1 class="alert alert-info">Add New Asset </h1>

<form action="" method="post">
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="assetName">Name</label>
            <input type="text" class="form-control" id="assetName" name = "assetName" placeholder="ex. Villa Sunset " required>
        </div>
        <div class="form-group col-md-4">
            <label for="assetType">Asset Type</label>
            <select id="assetType" name= "assetType" class="form-control">
                <!--  The options here are hard coded but it could be loaded from a database dynamically -->
                <option value="Entire House">Entire House</option>
                <option value="Apartment">Apartment</option>
                <option value="Shared Room">Shared Room</option>
        
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="assetRooms">Total Bedrooms</label>
            <input type="number" value="1" min="0" max="4" class="form-control" id="assetRooms" name = "assetRooms" required>
        </div>
        <div class="form-group col-md-4">
            <label for="assetDoubleBeds">Total Double Beds</label>
            <input type="number" value="1"  min="1" max="2" class="form-control" id="assetDoubleBeds" name = "assetDoubleBeds" required>
        </div>
        <div class="form-group col-md-4">
            <label for="assetSingleBeds">Total Single Beds</label>
            <input type="number"  value="1" min="0" max="3" class="form-control" id="assetSingleBeds" name = "assetSingleBeds" required>
        </div>
        <div class="form-group col-md-4">
            <label for="assetSofaBed">Sofa Bed</label>
            <input type="number" value="0" min="0" max="2" class="form-control" id="assetSofaBed" name = "assetSofaBed" required>
        </div>
        <div class="form-group col-md-4">
            <label for="assetPersons">Total Guests Capacity</label>
            <input type="number" value="2" min="1" max="8" class="form-control" id="assetPersons" name = "assetPersons" required>
        </div>
        <div class="form-group col-md-4">
            <label for="assetAddress">Address</label>
            <input type="text" class="form-control" id="assetAddress" name = "assetAddress" required>
        </div>
        
    </div>
    <?php
    // success message or error messages
        if(isset($StatusMessage))
            echo  $StatusMessage
    ?>
    <button type="submit" class="btn btn-primary" name="addAsset">Add Asset</button>
    <br>
</form>
<br>
