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
            userID int(11)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

          $this->mysqli->query($tableInit);
        return $this->mysqli;
    }

    public function getLinks(){
        $sql = "SELECT * FROM links";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function saveLink($code, $link){
        $checkSQL ="SELECT * FROM links WHERE code LIKE '".$code."'";
        $res = $this->mysqli->query($checkSQL);
        
        if($res->num_rows == 0){
            $sql="INSERT INTO links (code, link) VALUES ('".$code."', '".$link."')";
            $this->mysqli->query($sql);
        }
    }

   
}

?>