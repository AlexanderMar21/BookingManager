<?php
require_once "Classes/Users.php";
require_once "Classes/Database.php";
$message = "";

// if the button add new user was pressed

if(isset($_POST["addNewUser"])) {
    $imageChosen = "avatar.png"; // default profile image
    // if the user had chosen a photo and there a was problem during upload
    $imageStatus = false;
    // this is the second password input for 'Repeat Password'
    $password = (test_input($_POST['userPassword']));

    $user = new User();
    // for this example we use sha1 hashing
    $repeatedPassword = sha1(test_input($_POST['userPassword2']));
    $user->user_name = test_input($_POST['userName']);
    $user->user_surname = test_input($_POST['userSurname']);
    $user->user_username = test_input($_POST['userUserName']);
    $user->user_password = sha1(test_input($_POST['userPassword']));
    $user->user_type = test_input($_POST['userType']);
    // check the two passwords
    $passwordCheck = ($user->user_password == $repeatedPassword)?true : false;

    // ===   serverside validations   ===
    if(empty($password) || (strlen($password) < 5))
        $message .=" - Passoword must be at least 5 characters long and not spaces <br>";

    if ( $user->isUser()){
        $message .= " - Username already exists. Please try another !<br>";
    }
    if(empty($user->user_name) || (strlen($user->user_name) < 2))
        $message .=" - Name must be at least 2 characters long and not spaces. <br>";

    if(empty($user->user_surname) || (strlen($user->user_surname) < 3))
        $message .=" - Surname must be at least 3 characters long and not spaces. <br>";

    if (!$passwordCheck){
        $message .=" - Passwords dont match. <br>";
    }
    if(empty($user->user_username) || (strlen($user->user_username) < 5))
        $message .=" - Username must be at least 5 characters long and not spaces. <br>";

    // if there was a file chosen and the username is not already in our database and the passwords matched
    if(!empty($_FILES['profilePic']['name']) && !$user->isUser() && $passwordCheck) {
        // we call the function that uploads the photo and returns messages if there was an error uploading
      uploadProfileImage($user->user_username , "profilePic", $imageChosen , $message , $imageStatus);
    }

    // if the user had chosen a photo then the new filename will be saved in database like 'username.jpg(png etc)',
    // username is unique so a future upload (update) will overwrite that file with the new
    $user->user_photo = $imageChosen ;


    if($imageStatus == true && $passwordCheck && !$user->isUser() && $message == ""){
        $user->setDb();
        header("Location: index.php?action=132");
    } else if ( $passwordCheck && !$user->isUser() && $message == "" ){
        $user->setDb();
        header("Location: index.php?action=132");
    }

}
