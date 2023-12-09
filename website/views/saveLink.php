<?php
include "database.php";
if(isset($_POST['link']) && isset($_POST['code'])){
    $conn = new kapcsolat();
    $conn->saveLink($_POST['code'], $_POST['link']);
    print("okés");

}
?>