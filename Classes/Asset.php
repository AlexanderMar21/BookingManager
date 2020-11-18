<?php
// Asset reffers to the type of the asset (villa , studios ,shared room ) and its characteristics

//// Beginning of Asset Class
class Asset  {

    // === Field  ===
    var $asset_id ;
    var $asset_name;
    var $asset_type; 
    var $asset_rooms;
    var $asset_double_beds;
    var $asset_single_beds;
    var $asset_sofa_bed;
    var $asset_persons;
    var $asset_address;
    private $db;

    // === Constructors  ===
    function __construct(){
        $this->db = new Database();
        $this->asset_id = -1;
        $this->asset_name = "";
        $this->asset_type = "";
        $this->asset_rooms = -1;
        $this->asset_double_beds = -1;
        $this->asset_single_beds = -1;
        $this->asset_sofa_bed = -1;
        $this->asset_persons = -1;
        $this->asset_address = "";
    }

    // === Methods  ===

    function setDb(){   // We insert the data of one entry to the database
        $this->db->setAsset($this);
    }

    function getDb(){  // we retrieve the data from the database for a single entry
        $this->db->getAsset($this);
    }

    function deleteDb(){  // deleting and entry from our database
        $this->db->deleteAsset($this);
    }

    function updateDb($old_id){  // updating details of the entry
        $this->db->updateAsset($this, $old_id);
    }

    function  getALl(){   // retrieve all assets entries
        return $this->db->getAllAssets();
    }

    function getAllAvailable($checkIn , $checkOut , $persons ){  // get the available assets to be rented
        return $this->db->getAvailableAssets($checkIn , $checkOut , $persons );
    }

    function searchAll(){
        return $this->db->searchAllAssets($this);  // search specific assets or assets
    }

    ////////////////// END OF CLASS ASSET //////////////////////////
}