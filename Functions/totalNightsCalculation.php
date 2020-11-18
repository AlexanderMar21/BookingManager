<?php
/**
 * Created by PhpStorm.
 * User: alexandermargjoni
 * Date: 10/31/20
 * Time: 08:48
 */

require "../Functions/functions.php";
// ===== This page is called by AJAX ====
$chekIn = $_POST['checkIn'];
$chekOut = $_POST['checkOut'];
$totalNights = dateDiffrence($chekOut , $chekIn);
// It simply returs the total nights
if ( $totalNights == 0 || $totalNights < 0 ) {
    echo " <p type='number' class='form-control' id='totalNights' name = 'totalNights' p>  </p>";
}else {
    echo " <p type='number'  class='form-control' id='totalNights' name = 'totalNights' p> {$totalNights} </p>";
 }
