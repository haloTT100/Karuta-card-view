<?php
include "database.php";
if(isset($_GET['link']) && isset($_GET['code'])){
    $conn = new kapcsolat();
    $conn->saveLink($_GET['code'], $_GET['link']);
    print("okés");

}
?>