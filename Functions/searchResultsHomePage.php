<?php
include  '../Classes/Database.php';
include  '../Classes/Asset.php';
include  'functions.php';

// ===== this page is execute with AJAX =======

$searchResults = [];
$assets = new Asset();

// Search empty assets for specific  number of guests
$checkInSearch = test_input($_POST['checkIn']);
$checkOutSearch = test_input($_POST['checkOut']);
$numberPersons = test_input($_POST['numberPersons']);
$searchResults = $assets->getAllAvailable($checkInSearch,$checkOutSearch,$numberPersons);

?>
<!--   The reuslts of the search    -->
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Asset ID</th>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
        <th scope="col">Max Persons</th>
        <th scope="col">Sofa Bed</th>
        <th scope="col">Doubles Beds</th>
        <th scope="col">Single Beds</th>


    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($searchResults as $result) {
        $asset = new Asset();
        $asset->asset_id = $result['asset_id'];
        $asset->getDb();
        echo "<tr>";
        echo "<th scope='row'>{$asset->asset_id}</th>";
        echo "<th scope='row'>{$asset->asset_name}</th>";
        echo "<th scope='row'>{$asset->asset_address}</th>";
        echo "<th scope='row'>{$asset->asset_persons}</th>";
        echo "<th scope='row'>{$asset->asset_sofa_bed}</th>";
        echo "<th scope='row'>{$asset->asset_double_beds}</th>";
        echo "<th scope='row'>{$asset->asset_single_beds}</th>";

        echo "</tr>";
    }
    ?>
    </tbody>
</table>