<?php
// status message //
$message = "";
$StatusMessage="";

if(isset($_POST['addAsset'])){
    // ==== Create a new object ===
    $asset = new Asset();

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

    if($message != "")  // if we got any errors then the message will be printed in screen with the errors occurred
        $StatusMessage = "<div class='alert alert-danger' role='alert'>{$message}</div>";
    else { // else insert new asset in our databse and print success message
    $asset->setDb();
    $StatusMessage = "<div class='alert alert-success' role='alert'>Successfully Added </div>";
    }


}
