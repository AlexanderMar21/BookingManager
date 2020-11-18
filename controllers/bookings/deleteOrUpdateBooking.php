<?php
$message ="";
if(isset($_POST['updateBooking'])){
    $id = test_input($_POST['bookingId']);
    $booking = new Booking();
    $booking->booking_id = $id;
    $booking->booking_guest_name = test_input($_POST['guestName']);
    $booking->booking_guest_surname = test_input($_POST['guestSurname']);
    $booking->booking_guests_number = test_input($_POST['guestNumber']);
    $booking->guest_tel_number = test_input($_POST['guestTel']);
    $booking->guest_email = test_input($_POST['guestEmail']);
    $booking->booking_asset_id = test_input($_POST['assetName']);
    $booking->booking_check_in = test_input($_POST['checkIn']);
    $booking->booking_check_out = test_input($_POST['checkOut']);
    $booking->booking_cost = test_input($_POST['bookingCost']);
    $booking->booking_deposit = test_input($_POST['bookingDeposit']);
    $booking->booking_commission = test_input($_POST['bookingCommission']);
    $booking->booking_source = test_input($_POST['bookingSource']);
    $booking->booking_notes = test_input($_POST['bookingNotes']);
    $booking->updateDb();
    $message = "<div class='alert alert-success' role='alert'>Changes Saved</div>";
    header("Location: index.php?action=114&bookingId=".$id);
}
 if(isset($_POST['deleteBooking'])){
     $id = test_input($_POST['bookingId']);
     $booking = new Booking();
     $booking->booking_id = $id;
     $booking->deleteDb();
     header("Location: index.php?action=112");


 }