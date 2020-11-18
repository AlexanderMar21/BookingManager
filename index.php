<?php
session_start();
include_once("Classes/Database.php");
include_once("Classes/Booking.php");
include_once("Classes/Asset.php");
include_once("Classes/Users.php");
include_once("Classes/Prices.php");
include_once("Functions/functions.php");

if(!isset($_SESSION['userUserName'])){
    include_once("Includes/login.php");
}else{

    if(isset($_GET["action"])){
        $action = $_GET["action"];
        switch ($action) {
            ///////   Assets Menu
            case 101:
                if($_SESSION['userType'] == 1)
                    require_once("controllers/assets/newAsset.php");
                require_once ("Includes/mainLayout/header.php");
                if($_SESSION['userType'] == 1)
                    include("Includes/assetsViews/addNewAssetView.php");
                break;
            case 102:
                require_once("controllers/assets/allAssets.php");
                require_once ("Includes/mainLayout/header.php");
                include("Includes/assetsViews/allAssetsView.php");
                break;
            case 103:
                require_once("controllers/assets/searchAssets.php");
                require_once ("Includes/mainLayout/header.php");
                include("Includes/assetsViews/searchAssetsView.php");
                break;
            case 104:
                if($_SESSION['userType'] == 1)
                    require_once ("controllers/assets/deleteOrUpdateAsset.php");
                require_once("controllers/assets/viewAsset.php");
                require_once ("Includes/mainLayout/header.php");
                include("Includes/assetsViews/viewAssetView.php");
                break;

            ////  Bookings Menu
            case 111:
                require_once ("controllers/bookings/addBooking.php");
                require_once ("Includes/mainLayout/header.php");
                include("Includes/bookingViews/addBookingView.php");
                break; 
            case 112:
                require_once ("controllers/bookings/allBookings.php");
                require_once ("Includes/mainLayout/header.php");
                include("Includes/bookingViews/allBookingsView.php");
                break; 
            case 113:
                require ("controllers/bookings/searchBooking.php");
                require_once ("Includes/mainLayout/header.php");
                include("Includes/bookingViews/searchBookingView.php");
                break;
            case 114:
                require_once ("controllers/bookings/viewBooking.php");
                require_once ("Includes/mainLayout/header.php");
                include("Includes/bookingViews/viewBookingView.php");
                break;
            case 115:
                require_once ("controllers/bookings/deleteOrUpdateBooking.php");
                require_once ("Includes/mainLayout/header.php");
                break;
            /////  Financial Overview


            /////  User Settings
            case 131:
                if($_SESSION['userType'] == 1)
                    require_once ("controllers/users/addUser.php");
                require_once ("Includes/mainLayout/header.php");
                if($_SESSION['userType'] == 1)
                    include ("Includes/usersviews/addNewUserView.php");
                break;
            case 132:
                if($_SESSION['userType'] == 1)
                    require_once ("controllers/users/allUsers.php");
                require_once("Includes/mainLayout/header.php");
                if($_SESSION['userType'] == 1)
                    require_once("Includes/usersviews/allUsersView.php");

                break;


            default :
                require_once ("Includes/mainLayout/header.php");
                include_once("Includes/homePage.php");
        }
    } else {
        require_once ("Includes/mainLayout/header.php");
        include_once("Includes/homePage.php");
    }
    require ("Includes/mainLayout/footer.php");
}
