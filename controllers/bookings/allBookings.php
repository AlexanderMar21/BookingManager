<?php
// retrieve all upcoming bookings
$bookings = new Booking();
//   Start period <= (check in ) >= end period  and which asset we want to see
$results = $bookings->getAllBookingsByCheckIn(date("Y-m-d"),"","");
