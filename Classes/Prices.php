<?php

// ==== The class Prices represents a period of a fixed price for a specific period and for specific asset ==
class PricePeriod
{
    var $period_id;
    var $asset_id;
    var $price;
    var $start_date;
    var $end_period;
    var $db;

    function __construct(){
        $this->period_id = -1;
        $this->asset_id =  -1;
        $this->price = -1;
        $this->end_period = "0000-00-00";
        $this->end_period = "0000-00-00";
        $this->db = new Database();
    }
    // ===   Create a pricing period  ==
    public function setDb(){
        $this->db->setPrices($this);
    }
    // ===   Read one  period  ==
    public function getDb(){
        $this->db->getPrices($this);
    }
    // ===   Delete a single entry
    public function deleteDb(){
        $this->db->deletePrices($this);
    }
    // ===   Update a certain pricing period
    public function updateDb(){
        $this->db->updatePrices($this);
    }


}