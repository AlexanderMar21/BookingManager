<?php

$message = "";
// Error messages will be concatenated in next string
$errorMessages = "";
if(isset($_POST['addBooking'])){

    $booking = new Booking();

    $booking->booking_guest_name = test_input($_POST['guestName']);
    // check name if is more 2 and more characters and only text
    if(!isValidName($booking->booking_guest_name) || (strlen($booking->booking_guest_name) < 2))
        $errorMessages .= " - Guest name must be at least two (2) characters long and containing letters<br> ";

    $booking->booking_guest_surname = test_input($_POST['guestSurname']);
    // check surname if is more 2 and more characters and only text
    if(!isValidName($booking->booking_guest_surname) || (strlen($booking->booking_guest_surname) < 2))
        $errorMessages .= " - Guest surname must be at least two (2) characters long and containing letters <br>";

    $booking->booking_guests_number =  test_input($_POST['guestNumber']);
    // check guests numberid it is a number
    if(!isANumber($booking->booking_guests_number))
        $errorMessages .= " - Total guests field must be a number <br>";

    $booking->guest_tel_number = test_input($_POST['guestTel']); // if is set it should valid phone number
    if(!empty($booking->guest_tel_number)&& isTelNumber($booking->guest_tel_number))
        $errorMessages .= " - Telephone number field must be a number <br>";

    $booking->guest_email = test_input($_POST['guestEmail']);

    $booking->booking_asset_id = test_input($_POST['assetName']);
    $booking->booking_check_in = test_input($_POST['checkIn']);
    $booking->booking_check_out = test_input($_POST['checkOut']);
    $booking->booking_cost = test_input($_POST['bookingCost']);
    $booking->booking_deposit = test_input($_POST['bookingDeposit']);
    $booking->booking_commission= test_input($_POST['bookingCommission']);

    $booking->booking_source = test_input($_POST['bookingSource']);
    // Source should be always filled
    if(empty($booking->booking_source))
        $errorMessages .= " - Source field must be filled<br> ";
    // notes are not compulsory
    $booking->booking_notes = test_input($_POST['bookingNotes']);

    if($errorMessages != ""){
        $message = "<div class='alert alert-danger' role='alert'>{$errorMessages}</div>";
    }else {
        $booking->setDb();
        $message = "<div class='alert alert-success' role='alert'>Successfully Added </div>";
    }
}
