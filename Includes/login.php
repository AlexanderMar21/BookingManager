<?php
require_once 'Classes/Users.php';
    if(isset($_POST["loginBtn"])){
        $user = new User();
        $password = sha1(test_input($_POST['password']));
        $user->user_username = test_input($_POST['username']);
        $user->user_password = $password;
        $user->login();
        if( $user->user_id != -1){
            $_SESSION['userId'] = $user->user_id;
            $_SESSION['userUserName'] = $user->user_username;
            $_SESSION['userName'] = $user->user_name;
            $_SESSION['userSurname'] = $user->user_surname;
            $_SESSION['userType'] = $user->user_type;
            $_SESSION['userPhoto'] = $user->user_photo;
            header("Location: index.php");
        }

        }
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login - Booking Manager</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="public/static/css/loginPageStyles.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body id="body-login">

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2>Login</h2>

        <!-- Login Form -->
        <form action="#" method="post">
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="username">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" name="loginBtn" class="fadeIn fourth" value="Log In">
        </form>



    </div>
</div>

</body>
</html>

