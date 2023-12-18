<?php


class kapcsolat{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $mysqli;

    public function __construct(){
        $this->conn();
    }

    public function conn(){
        $this->host='localhost';
        $this->user='root';
        $this->pass='';
        $this->db='varazskartya';

        $this->mysqli= new mysqli($this->host, $this->user, $this->pass);

        $initSQL = "CREATE DATABASE IF NOT EXISTS ".$this->db;
        
        $this->mysqli->query($initSQL);

        mysqli_select_db($this->mysqli, $this->db);
        $tableInit = "CREATE TABLE IF NOT EXISTS links (
            code varchar(20) NOT NULL,
            number int(11) NOT NULL,
            edition int(11) NOT NULL,
            char_name text NOT NULL,
            series text NOT NULL,
            quality int(11) NOT NULL,
            frame tinyint(1) NOT NULL,
            wishlists int(11) NOT NULL,
            effort int(11) NOT NULL,
            link varchar(255),
            userID int(11),
            botID int(11)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

          $this->mysqli->query($tableInit);

          $usersTableInit = "CREATE TABLE IF NOT EXISTS users (
            id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username varchar(50) NOT NULL,
            password varchar(255) NOT NULL,
            email varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

        $this->mysqli->query($usersTableInit);

        return $this->mysqli;
    }

    public function getLinks(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        $userID = $this->getUserIdByEmail($_SESSION['email']);
        $sql = "SELECT * FROM links WHERE userID LIKE ".$userID;
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function saveLink($code, $link, $quality){
             $sql="UPDATE links SET link='".$link."', quality=".$quality." WHERE code='".$code."'";
        $this->mysqli->query($sql);

    }

    public function deleteLink($code){
        $sql="DELETE FROM links WHERE code='".$code."'";
        $this->mysqli->query($sql);
    }

    public function clearInvalid(){
        $sql="DELETE FROM links WHERE link='invalid'";
        $this->mysqli->query($sql);
    }

    public function isCodeExits($code, $quality){

        $checkSQL ="SELECT * FROM links WHERE code LIKE '".$code."'";
        $res = $this->mysqli->query($checkSQL);
        
        if($res->num_rows == 0){
            return false;
        }else{
            $sqlUpdate ="UPDATE links SET quality='".$quality."' WHERE code='".$code."'";
            $res = $this->mysqli->query($sqlUpdate);
        }

        return true;
    }

    public function saveCard($card, $botNum){
        if (session_status() === PHP_SESSION_NONE) session_start();
        $userID = $this->getUserIdByEmail($_SESSION['email']);

        $code = $card[0];
        $number = $card[1];
        $edition = $card[2];
        $char_name = $card[3];
        $series = $card[4];
        $quality = $card[5];
        $frame = $card[6] == '' ? '0' : '1';
        $wishlists = $card[7];
        $effort = $card[8];

        $char_name = str_replace('"', '""', $char_name);
        $series = str_replace('"', '""', $series);
        
        $char_name = str_replace("'", "''", $char_name);
        $series = str_replace("'", "''", $series);

        $sql='INSERT INTO links(
            code, 
            number, 
            edition, 
            char_name, 
            series, 
            quality, 
            frame, 
            wishlists, 
            effort, 
            link, 
            userID, botID) VALUES (
                "'.$code.'",
                '.$number.',
                '.$edition.',
                "'.$char_name.'",
                "'.$series.'",
                '.$quality.',
                '.$frame.',
                '.$wishlists.',
                '.$effort.',
                "",
                '.$userID.','.$botNum.')';

                //print($sql);
        $this->mysqli->query($sql);
    }

    public function getEmptyLinks($botNum){

        $sql1 = "SELECT * FROM links WHERE link LIKE '' AND botID LIKE ".$botNum." LIMIT 100";
        $res = $this->mysqli->query($sql1);

        return $res;
    }

    public function getAllCardsByUserID(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        $userID = $this->getUserIdByEmail($_SESSION['email']);

        $sql = "SELECT * FROM links WHERE userID LIKE ".$userID;
        $res = $this->mysqli->query($sql);

        return $res;
    }

    public function registerUser($username, $password, $passwordConfirm, $email) {
        // Check if email already exists
        $emailExistsQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->mysqli->query($emailExistsQuery);

        if ($result && $result->num_rows > 0) {
            return "Email address already exists";
        }

        // Check if passwords match
        if ($password !== $passwordConfirm) {
            return "Passwords do not match";
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into the database
        $insertUserQuery = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
        $insertResult = $this->mysqli->query($insertUserQuery);

        if ($insertResult) {
            return "Registration successful!";
        } else {
            return "Registration failed";
        }
    }

    public function loginUser($email, $password) {
        // Retrieve hashed password for the provided email
        $getUserQuery = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->mysqli->query($getUserQuery);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];

            // Verify the provided password
            if (password_verify($password, $hashedPassword)) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                return "Login successful!";
            } else {
                return "Invalid password";
            }
        } else {
            return "User not found";
        }
    }

    public function getUserIdByEmail($email) {
        $email = $this->mysqli->real_escape_string($email);

        $query = "SELECT id FROM users WHERE email = '".$email."'";
        $result = $this->mysqli->query($query);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user['id'];
        } else {
            return null; // Ha nincs találat
        }
    }

    public function getStatusByUser(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        $userID = $this->getUserIdByEmail($_SESSION['email']);
        $query = "SELECT link FROM links WHERE userID = ".$userID;
        
        $this->clearInvalid();
        $result = $this->mysqli->query($query);
        $waitC = 0;
        $doneC = 0;
        foreach($result as $link){
            if($link['link'] == ""){
                $waitC++;
            } else{
                $doneC++;
            }
        }
        $returnArray = array();
        array_push($returnArray, $waitC);
        array_push($returnArray, $doneC);
        return $returnArray;
    }

    public function getCards($start, $limit, $char_name, $series, $numberMin, $numberMax, $editionMin, $editionMax, $wishlistMin, $wishlistMax, $qualityMin, $qualityMax, $effortMin, $effortMax, $frame, $numberOrder, $editionOrder, $wishlistOrder, $qualityOrder, $effortOrder, $charNameOrder, $seriesOrder){
        if (session_status() === PHP_SESSION_NONE) session_start();
        $userID = $this->getUserIdByEmail($_SESSION['email']);
        $orderBy = "ORDER BY ";

        
        if($numberOrder == 'u') $orderBy = $orderBy . " number ASC,";
        if($numberOrder == 'd') $orderBy = $orderBy . " number DESC,";

        if($editionOrder == 'u') $orderBy = $orderBy . " edition ASC,";
        if($editionOrder == 'd') $orderBy = $orderBy . " edition DESC,";

        if($wishlistOrder == 'u') $orderBy = $orderBy . " wishlists ASC,";
        if($wishlistOrder == 'd') $orderBy = $orderBy . " wishlists DESC,";

        if($qualityOrder == 'u') $orderBy = $orderBy . " quality ASC,";
        if($qualityOrder == 'd') $orderBy = $orderBy . " quality DESC,";

        if($effortOrder == 'u') $orderBy = $orderBy . " effort ASC,";
        if($effortOrder == 'd') $orderBy = $orderBy . " effort DESC,";

        if($charNameOrder == 'u') $orderBy = $orderBy . " char_name ASC,";
        if($charNameOrder == 'd') $orderBy = $orderBy . " char_name DESC,";

        if($seriesOrder == 'u') $orderBy = $orderBy . " series ASC,";
        if($seriesOrder == 'd') $orderBy = $orderBy . " series DESC,";
        
        if($orderBy != "ORDER BY "){
            $orderBy = substr($orderBy, 0, -1);
            $orderBy = $orderBy . " ";
        } else{
            $orderBy = "";
        }
        $realFrame = $frame == '' ? '0' : '1';
        $query = "SELECT * FROM links WHERE userID LIKE ".$userID." AND link NOT LIKE ''".
        "AND number >= ".$numberMin." AND number <=".$numberMax." ".
        "AND edition >= ".$editionMin." AND edition <=".$editionMax." ".
        "AND wishlists >= ".$wishlistMin." AND wishlists <=".$wishlistMax." ".
        "AND quality >= ".$qualityMin." AND quality <=".$qualityMax." ".
        "AND effort >= ".$effortMin." AND effort <=".$effortMax." AND frame LIKE ".$realFrame." ".
        "AND char_name LIKE '%".$char_name."%' AND series LIKE '%".$series."%' ".
         $orderBy . 
         "LIMIT ".$start.", ".$limit."";
        $result = $this->mysqli->query($query);
        return $result;
    }

    public function getUserMinMax(){
        //RETURN ARRAY: 0-1=number;2-3=edition;4-5=wishlist;6-7=quality;8-9=effort (max,min)
        $rArray = array();
        if (session_status() === PHP_SESSION_NONE) session_start();
        $userID = $this->getUserIdByEmail($_SESSION['email']);

        $query = "SELECT MAX(number)AS numberMax, MIN(number)AS numberMin, 
        MAX(edition)AS editionMax, MIN(edition)AS editionMin, 
        MAX(wishlists)AS wishlistMax, MIN(wishlists)AS wishlistMin, 
        MAX(quality)AS qualityMax, MIN(quality)AS qualityMin, 
        MAX(effort)AS effortMax, MIN(effort)AS effortMin FROM links WHERE userID LIKE ".$userID."";
        $result = $this->mysqli->query($query);
        foreach($result as $vals) {
            array_push($rArray, $vals['numberMax']);
            array_push($rArray, $vals['numberMin']);
            array_push($rArray, $vals['editionMax']);
            array_push($rArray, $vals['editionMin']);
            array_push($rArray, $vals['wishlistMax']);
            array_push($rArray, $vals['wishlistMin']);
            array_push($rArray, $vals['qualityMax']);
            array_push($rArray, $vals['qualityMin']);
            array_push($rArray, $vals['effortMax']);
            array_push($rArray, $vals['effortMin']);
        }

        return $rArray;
    }


}

?>