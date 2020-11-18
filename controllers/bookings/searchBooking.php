<?php

$searchResults=[];

if(isset($_POST['searchBooking'])){
    // search for a booking that has the same values as the object we created
    $booking = new Booking();

    $booking->booking_id = test_input($_POST['bookingId']);
    $booking->booking_guest_name = test_input($_POST['guestName']);
    $booking->booking_guest_surname = test_input($_POST['guestSurname']);
    $booking->booking_guests_number = test_input($_POST['guestNumber']);
    $booking->guest_tel_number = test_input($_POST['guestTel']);
    $booking->guest_email = test_input($_POST['guestEmail']);
    $booking->booking_asset_id = test_input($_POST['assetName']);
    $booking->booking_cost = test_input($_POST['bookingCost']);
    $booking->booking_deposit = test_input($_POST['bookingDeposit']);
    $booking->booking_commission = test_input($_POST['bookingCommission']);
    $booking->booking_source = test_input($_POST['bookingSource']);
    $checkInStart = test_input($_POST['checkInFrom']);
    $checkInEnd = test_input($_POST['checkInTo']);
    $checkOutStart = test_input($_POST['checkOutFrom']);
    $checkOutEnd = test_input($_POST['checkOutTo']);

    $searchResults = $booking->searchBooking($checkInStart , $checkInEnd , $checkOutStart , $checkOutEnd );
}