<?php
include "database.php";
if(isset($_POST['link']) && isset($_POST['code'])&& isset($_POST['q'])){
    $conn = new kapcsolat();
    $conn->saveLink($_POST['code'], $_POST['link'], $_POST['q']);
    print("okés");

}
?>