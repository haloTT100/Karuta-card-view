<?php
include "database.php";
$conn = new kapcsolat();


$array = $conn->getStatusByUser();
echo '{"w": '.$array[0].', "d": '.$array[1].'}';
?>