<?php
include "database.php";
$conn = new kapcsolat();


$array = $conn->getCardsStatus();
echo "w: ".$array[0].", d: ".$array[1];
?>