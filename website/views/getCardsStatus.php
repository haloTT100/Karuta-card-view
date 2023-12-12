<?php
include "database.php";
$conn = new kapcsolat();


$array = $conn->getStatusByUser();
header("Content-Type: application/json");
echo '{"w": '.$array[0].', "d": '.$array[1].'}';
?>