<?php
/////  Databse class is referred to the connection with our database

class Database
{
    // ===  Fields  ===
    private $host;
    private $database;
    private $user;
    private $pass;
    private $pdo;
    private $opt;

    // ===  Constructors  ===
    public function __construct()  //
    {
        $this->host = "127.0.0.1";
        $this->database = "Bookings";
        $this->user = "root";
        $this->pass = "";
    }

    // ===  Methods  ===

    public function connect()    // Create and new PDO object that contains our connection
    {
        $this->opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false];
        $conString = "mysql:host=" . $this->host . ";dbname=" . $this->database . ";charset=utf8";  // Database details in  string  format
        $this->pdo = new PDO($conString, $this->user, $this->pass, $this->opt); // PDO object and PDO constructor
    }

    public function execute($sql, $array)   // Function to execute our prepared queries and return results
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($array);
        return $stmt;
    }


    public function loginUser(&$user){   //  Check the database if there is user with the username and the password
        $this->connect();
        $sql = "SELECT `user_id`, `user_username`, `user_name`, `user_surname`, `user_photo`, `user_type`";
        $sql .= " FROM `users` WHERE `user_username` = ? AND `user_password` = ?";
        $res = $this->execute($sql , [$user->user_username , $user->user_password]);
        if ($res->rowCount()==1){
            $row = $res->fetch();
            $user->user_id = $row['user_id'];
            $user->user_username = $row['user_username'];
            $user->user_name= $row['user_name'];
            $user->user_surname = $row['user_surname'];
            $user->user_photo = $row['user_photo'];
            $user->user_type = $row['user_type'];
        }
    }



    ////// Begining  Bookings Functions
    public function setBooking($booking){   // insert and new booking
        $this->connect();
        $sql = "INSERT INTO booking_details (`booking_guest_name`, `booking_guest_surname`, `booking_guests_number` ,";
        $sql .=" `guest_tel_number`, `booking_check_in`, `booking_check_out`, `booking_cost`, ";
        $sql .=" `booking_deposit`, `booking_commission`, `booking_source`, `booking_asset_id`, `guest_email`, `booking_notes` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
        $this->execute($sql , [$booking->booking_guest_name , $booking->booking_guest_surname , $booking->booking_guests_number,
        $booking->guest_tel_number , $booking->booking_check_in , $booking->booking_check_out ,
        $booking->booking_cost , $booking->booking_deposit , $booking->booking_commission ,
            $booking->booking_source , $booking->booking_asset_id ,$booking->guest_email , $booking->booking_notes]);

    }

    public function getBooking($booking){  // retrieve a single booking
        $this->connect();
        $sql = "SELECT `booking_id`, `booking_guest_name`, `booking_guest_surname`, booking_guests_number ,  `guest_tel_number`, ";
        $sql .= " `booking_check_in`, `booking_check_out`, `booking_cost`, `booking_deposit`, `booking_commission`,";
        $sql .= " `booking_source`, `booking_asset_id`, `guest_email` , booking_notes FROM `booking_details` WHERE `booking_id` = ?";
        $res = $this->execute($sql , [$booking->booking_id]);
        $row = $res->fetch();
        $booking->booking_id = $row['booking_id'];
        $booking->booking_guest_name = $row['booking_guest_name'];
        $booking->booking_guest_surname = $row['booking_guest_surname'];
        $booking->booking_guests_number = $row['booking_guests_number'];
        $booking->guest_tel_number = $row['guest_tel_number'];
        $booking->booking_check_in = $row['booking_check_in'];
        $booking->booking_check_out = $row['booking_check_out'];
        $booking->booking_cost = $row['booking_cost'];
        $booking->booking_deposit = $row['booking_deposit'];
        $booking->booking_commission = $row['booking_commission'];
        $booking->booking_source = $row['booking_source'];
        $booking->booking_asset_id = $row['booking_asset_id'];
        $booking->guest_email = $row['guest_email'];
        $booking->booking_notes = $row['booking_notes'];
    }

    public function deleteBooking($booking){  // delete single booking
        $this->connect();
        $sql = "DELETE FROM booking_details where booking_id =  ?  LIMIT 1";
        $this->execute($sql , [$booking->booking_id]);
    }

    public function updateBooking($booking){  // update details of a booking
        $this->connect();
        $sql = " UPDATE `booking_details` SET `booking_guest_name`= ? ,`booking_guest_surname`= ? ,`booking_guests_number`= ?,";
        $sql .= "`guest_tel_number`= ? ,`booking_check_in`= ? ,`booking_check_out`= ? ,`booking_cost`= ?,`booking_deposit`= ? ,";
        $sql .= " `booking_commission`= ? ,`booking_source`= ?,`booking_asset_id`= ?,`guest_email`= ? , ";
        $sql .= " `booking_notes`= ? WHERE `booking_id` = ?  LIMIT 1";
        $this->execute($sql , [$booking->booking_guest_name , $booking->booking_guest_surname ,$booking->booking_guests_number , $booking->guest_tel_number ,
            $booking->booking_check_in ,$booking->booking_check_out ,$booking->booking_cost , $booking->booking_deposit ,$booking->booking_commission ,
            $booking->booking_source , $booking->booking_asset_id  , $booking->guest_email  , $booking->booking_notes , $booking->booking_id] );
    }

    public function  getAllBookingsByCheckIn( $checkInStartPeriod , $checkInEndPeriod , $asset_id ){  // retrieve all bookings with ascending order with an option to filter the results by the check In Date
        $this->connect();
        $sql = "SELECT * FROM booking_details";
        $w = " where ? ";
        $i = 0;
        $a = [];
        $a[$i++] = "1";  // the query by default retrieves all entries
        if( $asset_id !=""){          // if we set id of asset will retrieve data of that specific asset
            $w = $w . " and booking_asset_id = ? ";
            $a[$i++] = $asset_id;
        }
        if( $checkInStartPeriod !="") {     // if we set a period
            $w = $w . " and booking_check_in >= ? ";
            $a[$i++] = $checkInStartPeriod;
        }
        if($checkInEndPeriod != ""){
            $w = $w . " and booking_check_in <= ? ";
            $a[$i++] = $checkInEndPeriod;

        }
        $sql .= $w;
        $sql .= " ORDER BY booking_check_in ASC";  // ASC by check-in because the bookings would be upcoming
        $res = $this->execute($sql , $a );
        return $results =  $res->fetchAll();
    }
    public function  searchAllBookings( $booking , $checkInStartPeriod , $checkInEndPeriod , $checkOutStartPeriod ,$checkOutEndPeriod ){
        // retrieve all bookings with ascending order with an option to filter the results by the check In , guest name , surname etc...
        $this->connect();
        $sql = "SELECT * FROM booking_details";
        $w = " where ? ";
        $i = 0;
        $a = [];
        $a[$i++] = "1";
        if( $booking->booking_id !=""){
            $w = $w . " and booking_id = ? ";  // if a value is set then  we concatenate  to our main sql query
            $a[$i++] = $booking->booking_id;
        }
        if( $booking->booking_guest_surname !="") {
            $w = $w . " and booking_guest_surname LIKE ? ";
            $a[$i++] = "%".$booking->booking_guest_surname."%";
        }
        if( $booking->booking_guest_name !="") {
            $w = $w . " and booking_guest_name LIKE ? ";
            $a[$i++] = "%".$booking->booking_guest_name."%";
        }
        if( $booking->booking_guests_number !=""){
            $w = $w . " and booking_guests_number = ? ";
            $a[$i++] = $booking->booking_guests_number;
        }
        if( $booking->guest_tel_number !=""){
            $w = $w . " and guest_tel_number LIKE ? ";
            $a[$i++] = "%".$booking->guest_tel_number."%";
        }
        if( $checkInStartPeriod !=""){
            $w = $w . " and booking_check_in >= ? ";
            $a[$i++] = $checkInStartPeriod;
        }
        if($checkInEndPeriod != ""){
            $w = $w . " and booking_check_in <= ? ";
            $a[$i++] = $checkInEndPeriod;
        }
        if( $checkOutStartPeriod !=""){
            $w = $w . " and booking_check_out >= ? ";
            $a[$i++] = $checkOutStartPeriod;
        }
        if($checkOutEndPeriod != ""){
            $w = $w . " and booking_check_out <= ? ";
            $a[$i++] = $checkOutEndPeriod;
        }
        if($booking->booking_cost != ""){
            $w = $w . " and booking_cost = ? ";
            $a[$i++] = $booking->booking_cost;
        }
        if($booking->booking_deposit != ""){
            $w = $w . " and booking_deposit = ? ";
            $a[$i++] = $booking->booking_deposit;
        }
        if($booking->booking_commission != ""){
            $w = $w . " and booking_commission = ? ";
            $a[$i++] = $booking->booking_commission;
        }
        if($booking->booking_source != ""){
            $w = $w . " and booking_source LIKE ? ";
            $a[$i++] = "%".$booking->booking_source."%";
        }
        if($booking->booking_asset_id != ""){
            $w = $w . " and booking_asset_id = ? ";
            $a[$i++] = $booking->booking_asset_id;
        }
        if($booking->guest_email != ""){
            $w = $w . " and guest_email LIKE ? ";
            $a[$i++] = "%".$booking->guest_email."%";
        }

        $sql .= $w;
        $sql .= " ORDER BY booking_check_in ASC";
        $res = $this->execute($sql , $a );
        $results =  $res->fetchAll();
        return $results ;
    }

    public function  getAllBookingsByCheckOut( $checkOutStartPeriod , $checkOutEndPeriod , $asset_id ){
        // retrieve all bookings with ascending order with an option to filter the results by the check In Date
        $this->connect();
        $sql = "SELECT * FROM booking_details";
        $w = " where ? ";
        $i = 0;
        $a = [];
        $a[$i++] = "1";
        if( $asset_id !=""){  // if we like to see for a specific asset
            $w = $w . " and booking_asset_id = ? ";
            $a[$i++] = $asset_id;
        }
        if( $checkOutStartPeriod !="") {  // if we provide
            $w = $w . " and booking_check_out >= ? ";
            $a[$i++] = $checkOutStartPeriod;
        }
        if($checkOutEndPeriod != ""){
            $w = $w . " and booking_check_out <= ? ";
            $a[$i++] = $checkOutEndPeriod;

        }
        $sql .= $w;
        $sql .= " ORDER BY booking_check_in ASC";
        $res = $this->execute($sql , $a );
        return $results =  $res->fetchAll();
    }

    public function getAllBookingsCleaningDay($date , $cleaningFrequency){
        // assets (houses , apartments ) must be cleaned every certain days . Those preferences could be defined a new sql table and could be updated from the user
        $this->connect();
        $sql = "SELECT DATEDIFF( ? , booking_check_in ) AS days_passed , `booking_id`, `booking_guest_name`, `booking_guest_surname`, ";  // with datediff we retrieve how many days passed from check in
        $sql .= "`booking_guests_number`, `guest_tel_number`, `booking_check_in`, `booking_check_out`, `booking_cost`,";
        $sql .= " `booking_deposit`, `booking_commission`, `booking_source`, `booking_asset_id`, `guest_email`, ";
        $sql .= " `booking_notes` FROM `booking_details` ";
        $sql .= " WHERE booking_check_in < ? and booking_check_out > ? ";    //  the day should be in the booking stay period
        $sql .= " HAVING (days_passed % ?) = 0 ORDER BY booking_asset_id ASC";  // ex 6 days % 3 = 0 every 3 days would be cleaning day
        return $results = $this->execute($sql , [$date , $date , $date , $cleaningFrequency]);
    }

    ////// END OF BOOKINGS FUNCTIONS

    /////// Beginning of Asset Functions

    public function setAsset($asset){
        // insert asset in our database
        $this->connect();
        $sql = "INSERT INTO `assets`(`asset_name`, `asset_type`, `asset_rooms`," ;
        $sql .= " `asset_double_beds`, `asset_single_beds`, `asset_sofa_bed`, `asset_persons`,";
        $sql .= " `asset_address`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $this->execute($sql , [$asset->asset_name, $asset->asset_type, $asset->asset_rooms, $asset->asset_double_beds,
                $asset->asset_single_beds, $asset->asset_sofa_bed, $asset->asset_persons,
                $asset->asset_address]);
    }

    public function getAsset($asset){
        //   retrieve an entry from specific id
        $this->connect();
        $sql = "SELECT `asset_id`, `asset_name`, `asset_type`, `asset_rooms`, `asset_double_beds`,";
        $sql .= " `asset_single_beds`, `asset_sofa_bed`, `asset_persons`, `asset_address`";
        $sql .= " FROM `assets` WHERE `asset_id` = ?";
        $res = $this->execute( $sql , [$asset->asset_id]);
        $row = $res->fetch();
        $asset->asset_id = $row['asset_id'];
        $asset->asset_name = $row['asset_name'];
        $asset->asset_type = $row['asset_type'];
        $asset->asset_rooms = $row['asset_rooms'];
        $asset->asset_double_beds = $row['asset_double_beds'];
        $asset->asset_single_beds = $row['asset_single_beds'];
        $asset->asset_sofa_bed = $row['asset_sofa_bed'];
        $asset->asset_persons = $row['asset_persons'];
        $asset->asset_address = $row['asset_address'];
    }
        

    public function getAllAssets(){
        // retrieve all assets (also used for drop-downs)
        $this->connect();
        $sql = "SELECT `asset_id`, `asset_name`, `asset_type`, `asset_rooms`, `asset_double_beds`, `asset_single_beds`, `asset_sofa_bed`, ";
        $sql .= "`asset_persons`, `asset_address` FROM `assets`";
        $res = $this->execute($sql ,[]);
        return $rows = $res->fetchAll();
    }

    public function getAvailableAssets($checkIn , $checkOut , $persons ){
        // retreieve our empty assets for specific dates and persons
        /// =====   The inner query retrieves the assets that have guests staying in ..
        ///  and the outside retrieves the assets that are not in the results of the inner query   ====

        $this->connect();
        $sql = " SELECT * FROM assets WHERE asset_persons >= ? and  asset_id NOT IN (SELECT assets.asset_id from booking_details  ";
        $sql .= "left join Assets on booking_details.booking_asset_id = assets.asset_id where ( ? < booking_details.booking_check_out and ";
        $sql .= "? > booking_details.booking_check_out) OR ( ? < booking_details.booking_check_in and ? > booking_details.booking_check_out) or ( ";
        $sql .= " ? >= booking_details.booking_check_in and ? <= booking_details.booking_check_out) or ";
        $sql .= " ( ? < booking_details.booking_check_in and ? > booking_details.booking_check_in)) ";
        $res = $this->execute($sql , [$persons , $checkIn , $checkOut , $checkIn , $checkOut , $checkIn , $checkOut , $checkIn ,$checkOut]);
        return $rows = $res->fetchAll();
    }


    public function deleteAsset($asset){
        $this->connect();
        $sql = "DELETE FROM assets WHERE asset_id = ? LIMIT 1";
        $this->execute($sql , [$asset->asset_id]);
    }

    public function updateAsset($asset){
        $this->connect();
        $sql = " UPDATE `assets` SET `asset_name`= ? ,`asset_type`= ? ,`asset_rooms`= ? ,`asset_double_beds`= ? , ";
        $sql.= " `asset_single_beds`= ? ,`asset_sofa_bed`= ?,`asset_persons`= ?,`asset_address`= ? WHERE `asset_id` = ?  LIMIT 1";
        $this->execute($sql , [$asset->asset_name , $asset->asset_type , $asset->asset_rooms , $asset->asset_double_beds ,
            $asset->asset_single_beds , $asset->asset_sofa_bed , $asset->asset_persons , $asset->asset_address , $asset->asset_id] );
    }
    
    public function searchAllAssets($asset){
        // Search all assets according to creteria
        $this->connect();
        $sql = "SELECT * FROM  assets ";
        $w = " where ? ";
        $i = 0;
        $a = [];
        $a[$i++] = "1";   // retrieve all entries if the search form was left empty
        if( $asset->asset_id !=""){                             // if the form has fields filled the below will be checked
            $w = $w . " and asset_id = ? ";   // OR  $w .=  " and asset_id = ? ";  We concatenate
            $a[$i++] = $asset->asset_id;
        }
        if( $asset->asset_name !="") {  // if we provide
            $w = $w . " and asset_name LIKE ? ";
            $a[$i++] = "%".$asset->asset_name."%";
        }
        if( $asset->asset_type!= ""){
            $w = $w . " and asset_type LIKE ? ";
            $a[$i++] = "%".$asset->asset_type."%";
        }
        if( $asset->asset_rooms !=""){
            $w = $w . " and asset_rooms = ? ";
            $a[$i++] = $asset->asset_rooms;
        }
        if( $asset->asset_double_beds !=""){
            $w = $w . " and asset_double_beds = ? ";
            $a[$i++] = $asset->asset_double_beds;
        }
        if( $asset->asset_single_beds !=""){
            $w = $w . " and asset_single_beds = ? ";
            $a[$i++] = $asset->asset_single_beds;
        }
        if( $asset->asset_persons !=""){
            $w = $w . " and asset_persons = ? ";
            $a[$i++] = $asset->asset_persons;
        }
        if( $asset->asset_sofa_bed !=""){
            $w = $w . " and asset_sofa_bed = ? ";
            $a[$i++] = $asset->asset_sofa_bed;
        }
        if( $asset->asset_address !=""){
            $w = $w . " and asset_address LIKE ? ";
            $a[$i++] = "%". $asset->asset_address . "%";
        }
        $sql .= $w;
        $sql .= " ORDER BY asset_id ASC";
        $res = $this->execute($sql , $a );
        return $results =  $res->fetchAll();
    }


    ////// ENd of Asset Functions



    //////Beginning of User Functions
    public function setUser($user){   // this function is only accessible from the admin users
        $this->connect();
        $sql = " INSERT INTO `users`( `user_username`, `user_name`, `user_surname`, `user_password`, `user_photo` , ";
        $sql .= " `user_type`) VALUES (? , ? , ? , ? , ? , ?) ";
        $this->execute($sql , [ $user->user_username , $user->user_name , $user->user_surname ,
            $user->user_password , $user->user_photo , $user->user_type]);

    }

    public function getUser($user){   // retrieve a yser
        $this->connect();
        $sql = " SELECT `user_id`, `user_username`, `user_name`, `user_surname`, `user_photo`, `user_type` ";
        $sql .= " FROM `users` WHERE `user_id` = ? LIMIT 1";
        $res = $this->execute($sql , [$user->user_id]);
        $row = $res->fetch();
        $user->user_id = $row['user_id'];
        $user->user_username= $row['user_username'];
        $user->user_name = $row['user_name'];
        $user->user_surname = $row['user_surname'];
        $user->user_photo = $row['user_photo'];
        $user->user_type = $row['user_type'];
    }

    public function updateUser($user){
        $this->connect();
        $sql = "";
    }

    public function deleteUser($user){
        $this->connect();
        $sql = "DELETE FROM users WHERE user_id = ? ";
        $this->execute($sql , [$user-user_id]);
    }

    public function isAlreadyUser($user){     // when we add a new user we need to see if the userame already exists in our database
        $this->connect();
        $sql = "SELECT * FROM users WHERE user_username =  ? ";
        $res = $this->execute($sql , [$user->user_username] );
        if($res->rowCount() > 0  ){  /// if we have more than 0 rows means there is a user with that username already
            return true;
        } else {
            return false;
        }
    }

    public function getAllUsers(){    // admin users will be able to see all users
        $this->connect();
        $sql = " SELECT `user_id`, `user_username`, `user_name`, `user_surname`, `user_photo`, `user_type` FROM `users`  ";
        $res =  $this->execute($sql , []);
        return $res->fetchAll();

    }

    /// End of User Functions
    ///
    //// Beginning of Prices Functions

    public function  setPrices($prices){    //   set a fixed price for an asset for a specific period (prices are loaded by async function during booking)
        $this->connect();
        $sql = " INSERT INTO `prices`(`asset_id`, `price`, `start_period`, `end_period`) VALUES (? , ? , ? ,?)";
        $this->execute( $sql , [$prices->asset_id , $prices->price , $prices->start_period , $prices->end_period ]);
    }

    public function getPrices($prices){    // retrieve the price for that specific period id
        $this->connect();
        $sql = "SELECT period_id, `asset_id`, `price`, `start_period`, `end_period` FROM `prices` WHERE period_id = ?";
    }

    ///////// End Of Prices Functions


    ////////////////// END OF CLASS DATABASE //////////////////////////
}
