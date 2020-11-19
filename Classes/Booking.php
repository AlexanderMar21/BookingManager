<?php

// Class Booking Refers to the bookings that we receive

class Booking
{
    var $booking_id;
    var $booking_guest_name;
    var $booking_guest_surname;
    var $booking_guests_number;
    var $guest_tel_number;
    var $booking_check_in;
    var $booking_check_out;
    var $booking_cost;
    var $booking_deposit;
    var $booking_commission;
    var $booking_source;
    var $booking_asset_id;
    var $guest_email;
    var $booking_notes;
    private $db;

    function __construct()
        {
            $this->db = new Database();
            $this->booking_id = -1;
            $this->booking_guest_name = "";
            $this->booking_guest_surname = "";
            $this->booking_guests_number = -1;
            $this->guest_tel_number = "";
            $this->booking_check_in = "0000-00-00";
            $this->booking_check_out = "0000-00-00";
            $this->booking_cost = -1;
            $this->booking_deposit = -1;
            $this->booking_commission = -1;
            $this->booking_source = "";
            $this->booking_asset_id = -1;
            $this->guest_email = "";
            $this->booking_notes = "";

        }
    
    function getDb()       // retrieve the data from one booking entry
    {
        $this->db->getBooking($this);
    }
    function setDb()    // insert one new booking entry to our database
    {
        $this->db->setBooking($this);
    }
    function updateDb()   // update a single booking entry
    {
        $this->db->updateBooking($this);
    }
    function deleteDb()  // delete a single entry
    {
        $this->db->deleteBooking($this);
    }

    function getAllBookingsByCheckIn( $checkInStartPeriod , $checkInEndPeriod , $asset_id){  // retrieve bookings in certain period by check in
        return $this->db->getAllBookingsByCheckIn( $checkInStartPeriod , $checkInEndPeriod , $asset_id );
    }

   function searchBooking($checkInStart , $checkInEnd , $checkOutStart , $checkOutEnd){  // search bookings
        return $this->db->searchAllBookings($this ,$checkInStart , $checkInEnd , $checkOutStart, $checkOutEnd );
   }

    function  getAllBookingsByCheckOut( $checkOutStartPeriod , $checkOutEndPeriod , $asset_id ){ // retrieve bookings in certain period by check out
        return $this->db->getAllBookingsByCheckOut( $checkOutStartPeriod , $checkOutEndPeriod , $asset_id );
    }

    function getAllBookingsCleaningDay($date , $cleaningFrequency){  // retrieve the assets that shoule be cleaned in the specific day
        return $this->db->getAllBookingsCleaningDay($date , $cleaningFrequency);
    }

    function  getAll()   // return all booking entries
    {
        return $this->db->getAllBookings();

    }



            ///////// END OF CLASS BOOKINGS   ///////////////////

    }
