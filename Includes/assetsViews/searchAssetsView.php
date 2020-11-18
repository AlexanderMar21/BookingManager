<br>
<h1 class="alert alert-info" >Search Assets</h1>

<form action="" method="post">
    <div class="form-row">

        <div class="form-group col-md-4">
            <label for="assetId">Asset ID</label>
            <input type="number" min="0" max="4" class="form-control" id="assetId" name = "assetId" >
        </div>

        <div class="form-group col-md-4">
            <label for="assetName">Name</label>
            <input type="text" class="form-control" id="assetName" name = "assetName" placeholder="ex. Villa Sunset ">
        </div>
        <div class="form-group col-md-4">
            <label for="assetType">Asset Type</label>
            <select id="assetType" name= "assetType" class="form-control">
                <!--  The options are hard coded but it could be loaded from a database dynamically -->
                <option selected value="">....</option>
                <option value="Entire House">Entire House</option>
                <option value="Apartment">Apartment</option>
                <option value="Shared Room">Shared Room</option>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="assetRooms">Total Bedrooms</label>
            <input type="number" min="0" max="4" class="form-control" id="assetRooms" name = "assetRooms" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetDoubleBeds">Total Double Beds</label>
            <input type="number"  min="1" max="2" class="form-control" id="assetDoubleBeds" name = "assetDoubleBeds" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetSingleBeds">Total Single Beds</label>
            <input type="number"  min="0" max="3" class="form-control" id="assetSingleBeds" name = "assetSingleBeds" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetSofaBed">Sofa Bed</label>
            <input type="number" min="0" max="2" class="form-control" id="assetSofaBed" name = "assetSofaBed" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetPersons">Total Guests Capacity</label>
            <input type="number" min="1" max="8" class="form-control" id="assetPersons" name = "assetPersons" >
        </div>
        <div class="form-group col-md-4">
            <label for="assetAddress">Address</label>
            <input type="text" class="form-control" id="assetAddress" name = "assetAddress" >
        </div>

    </div>
    <button type="submit" class="btn btn-primary" name="searchAsset">Search</button>
    <br>
</form>
<br>
<div>
    <!-- The table is hidden at the load of the page   -->
    <?php if(isset($_POST['searchAsset'])) { ?>
        <h4 class="alert alert-success">Search Results</h4>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Asset ID</th>
                <th scope="col">Asset Name</th>
                <th scope="col">Asset Type</th>
                <th scope="col">Capacity</th>
                <th scope="col">Double Beds</th>
                <th scope="col">Single Beds</th>
                <th scope="col">Address</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($searchResults as $row) {
                echo "<tr>";
                echo "<td scope='row'><a href='index.php?action=104&assetId={$row['asset_id']}'>{$row['asset_id']}</a></td>";
                echo "<td scope='row'>{$row['asset_name']}</td>";
                echo "<td scope='row'>{$row['asset_type']}</td>";
                echo "<td scope='row'>{$row['asset_persons']}</td>";
                echo "<td scope='row'>{$row['asset_double_beds']}</td>";
                echo "<td scope='row'>{$row['asset_single_beds']}</td>";
                echo "<td scope='row'>{$row['asset_address']}</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <br>
    <?php } ?>
</div>
