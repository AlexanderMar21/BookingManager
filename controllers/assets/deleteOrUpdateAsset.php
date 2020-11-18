<?php
// message will be used to store the status of the update and print it in the view section
$message ="";
$statusMessage="";
//  update the details from an asset , IDs once they wont be able to be changed
if(isset($_POST['updateAsset'])){
    $assetId = test_input($_POST['assetId']);  // test_input is a function that strip slashes and white spaces and html characters
    $asset = new Asset();
    $asset->asset_id = $assetId;

    // === Set object fields from user inputs
    $asset->asset_name = test_input($_POST['assetName']);
    if( !isValidCodeName($asset->asset_name))   // ===  Check inputs if they follow REGEX pattern
        $message .=" - Asset name field can contain english letters and numbers and ( _ , - , ~) and not be empty<br>";

    $asset->asset_type = test_input($_POST['assetType']);
    if(!isValidCodeName( $asset->asset_type))
        $message .=" - Asset type field can contain english letters and numbers and ( _ , - , ~) and not be empty<br>";

    $asset->asset_rooms = test_input($_POST['assetRooms']);
    if(!isANumber( $asset->asset_rooms))  //  === Numberic inputs should only have numbers
        $message .=" - Rooms field can contain only numbers and not be empty <br> ";

    $asset->asset_double_beds = test_input($_POST['assetDoubleBeds'] );
    if(!isANumber( $asset->asset_double_beds))
        $message .=" - Double beds field can contain only numbers and not be empty<br>";

    $asset->asset_single_beds = test_input($_POST['assetSingleBeds']);
    if(!isANumber( $asset->asset_single_beds))
        $message .=" - Single beds field can contain only numbers and not be empty<br>";

    $asset->asset_sofa_bed = test_input($_POST['assetSofaBed']);
    if(!isANumber( $asset->asset_sofa_bed))
        $message .=" - Sofa beds field can contain only numbers and not be empty<br>";

    $asset->asset_persons = test_input($_POST['assetPersons']);
    if(!isANumber( $asset->asset_persons))
        $message .=" - Total guest capacity field can contain only numbers and not be empty<br>";

    $asset->asset_address = test_input($_POST['assetAddress']);
    if(empty($asset->asset_address) || (strlen($asset->asset_address) < 3))
        $message .=" - Address field can not be empty and less than 3 characters<br>";

    if($message!= ""){
        $statusMessage = "<div class='alert alert-danger' role='alert'>{$message}</div>";
    }else {
        $asset->updateDb($asset->asset_id);
        $statusMessage = "<div class='alert alert-success' role='alert'>Changes were successfully saved </div>";
        //header("Location: index.php?action=104&assetId=" . $assetId);
    }
}

// delete the entry //
 if(isset($_POST['deleteAsset'])){
    $assetId = test_input($_POST['assetId']);
    $asset = new Asset();
    $asset->asset_id = $assetId;
    $asset->deleteDb();
    header("Location: index.php?action=102");

 }
