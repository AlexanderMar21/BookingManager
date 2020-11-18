<?php
// sanitize our data from user iputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
    // a funcion that returns the difference betweeen to dates
  function dateDiffrence($date2 , $date1 ){
      $your_date_one = strtotime($date1);
      $your_date_two = strtotime($date2);
      $datediff = $your_date_two - $your_date_one;

      return round($datediff / (60 * 60 * 24));
  }

  //  number inputs should contain only numbers
  function isANumber($str){
      $pattern = '/^[0-9]+$/';
      if( preg_match_all($pattern, $str))
          return true;
      else
          return false;
  }

//  id inputs could contain only numbers , letters and few characters
function isValidCodeName($str){
    $pattern = "/^[a-zA-Z0-9_ ~\-]+$/";
    if( preg_match_all($pattern, $str))
        return true;
    else
        return false;
}

// People names
function isValidName($str){
    $pattern = "/^[a-zA-Z ,\']+$/";
    if( preg_match_all($pattern, $str))
        return true;
    else
        return false;
}

// if matches the telephone format
function isTelNumber($str){
    $pattern = '/^[0-9 \-\+]+$/';
    if( preg_match_all($pattern, $str))
        return true;
    else
        return false;
}
// the below function is uploading a user profile picture
function uploadProfileImage($username ,$inputName, &$defaultImageName , &$message , &$imageStatus ){

    $fileName = $_FILES[$inputName]['name'];
    $fileTmpName = $_FILES[$inputName]['tmp_name'];
    $fileError = $_FILES[$inputName]['error'];
    $fileSize = $_FILES[$inputName]['size'];

    $fileExtension = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExtension));
    $allowed = array('jpg', 'jpeg', 'png');
    // ==  If the file extesion not in the above array
    if (in_array($fileActualExt, $allowed)) {
        // == if errors are 0
        if ($fileError === 0) {
            //  file size smaller than +- 600kB
            if ($fileSize < 600000) {
                // change the file name to the user  username which is unique
                $fileNameNew = $username . "." . $fileActualExt;
                // the file destination
                $target_dir = "images/uploads/avatars/" . $fileNameNew;
                // if the user had chosen a photo then it will update the default image
                $defaultImageName = $fileNameNew;
                move_uploaded_file($fileTmpName, $target_dir);
                $imageStatus = true;
            } else {
                // file size exceeds
                $message .= " - The file size exceeds 500KB <br>";
            }
        } else {
            // == any error
            $message .= " - There was an error Uploading you image <br>";
        }
    } else {
        // not valid file type
        $message .= " - You cant upload files of that type <br>";
    }

}