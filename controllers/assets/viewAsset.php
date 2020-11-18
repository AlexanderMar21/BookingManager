<?php
///  ==== If is set the Get parameter a new asset object will be created
if(isset($_GET["assetId"])){
    $asset_id = test_input($_GET["assetId"]);
    $asset = new Asset();
    $asset->asset_id = $asset_id;
    // ==  Get details from asset according the id ==
    $asset->getDb();
}
