<?php

// === Search Assets  ===
$searchResults = [];
if(isset($_POST['searchAsset'])) {
    // create an object with the inputs fields
    $asset = new Asset();
    $asset->asset_id = test_input($_POST['assetId']);
    $asset->asset_name = test_input($_POST['assetName']);
    $asset->asset_type = test_input($_POST['assetType']);
    $asset->asset_rooms = test_input($_POST['assetRooms']);
    $asset->asset_double_beds = test_input($_POST['assetDoubleBeds']);
    $asset->asset_single_beds = test_input($_POST['assetSingleBeds']);
    $asset->asset_sofa_bed = test_input($_POST['assetSofaBed']);
    $asset->asset_persons = test_input($_POST['assetPersons']);
    $asset->asset_address = test_input($_POST['assetAddress']);
    // the call the Class Function that searches for an asset depending creteria
    $searchResults = $asset->searchAll();

    }
