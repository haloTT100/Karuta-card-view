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

        $this->mysqli= new mysqli($this->host, $this->user, $this->pass, $this->db);
        return $this->mysqli;
    }

    public function getLinks(){
        $sql = "SELECT * FROM links";
        $res = $this->mysqli->query($sql);
        return $res;
    }

    public function saveLink($code, $link){
        $checkSQL ="SELECT * FROM links (code, link) VALUES ('".$code."', '".$link."')";
        $sql="INSERT INTO links (code, link) VALUES ('".$code."', '".$link."')";
        $this->mysqli->query($sql);
        $last_id = $this->mysqli->insert_id;
        return $last_id;
    }

   
}

?>