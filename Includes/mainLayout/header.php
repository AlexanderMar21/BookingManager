<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Booking Manager</title>
            <link rel="stylesheet" href="public/static/css/styles.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <script src="JS/js.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-dark" >
              <a class="navbar-brand" href="index.php">bOOKING Mng.</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Assets
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="index.php?action=101">Add new Asset</a>
                      <a class="dropdown-item" href="index.php?action=102">All Assets</a>
                      <a class="dropdown-item" href="index.php?action=103">Search Asset</a>
                    </div>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Bookings
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="index.php?action=111">Add new Booking</a>
                      <a class="dropdown-item" href="index.php?action=112">All Bookings</a>
                      <a class="dropdown-item" href="index.php?action=113">Search Bookings</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Financial
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="#">Manage Booking Prices</a>
                      <a class="dropdown-item" href="#">Financial Reports</a>
                    </div>
                  </li>
                </ul>

              </div>
                <div class="collapse navbar-collapse user" id="navbarNavDropdown">
                    <ul class="navbar-nav navbar-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- Print who is the user logged in -->
                                <?php echo $_SESSION['userName']." ".$_SESSION['userSurname'] ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <div id="avatar" style=" background-image: url('images/uploads/avatars/<?php echo $_SESSION['userPhoto']?>');" > </div>
                                <hr>
                                <a class='dropdown-item' href='index.php'>My Account</a>
                                <!-- Simple users cant see the below -->
                                <?php if($_SESSION['userType'] == 1) {
                                    echo "<a class='dropdown-item' href='index.php?action=131'>Add New User</a>";
                                    echo "<a class='dropdown-item' href='index.php?action=132'>Show All Users</a>";
                                }
                                ?>
                                <a class="dropdown-item" href="Includes/logout.php">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="wrapper">
