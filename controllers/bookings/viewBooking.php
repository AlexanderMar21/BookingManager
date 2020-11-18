<?php
//  retrieve tge data for a specific booking
if(isset($_GET["bookingId"])){
$booking_id = test_input($_GET["bookingId"]);
$booking = new Booking();
$booking->booking_id = $booking_id;
$booking->getDb();
}