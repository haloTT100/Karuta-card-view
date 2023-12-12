<?php
include "database.php";
$conn = new kapcsolat();


$array = $conn->getStatusByUse();
echo "w: ".$array[0].", d: ".$array[1];
?>