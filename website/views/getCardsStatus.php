<?php
include "database.php";
$conn = new kapcsolat();


$array = $conn->getStatusByUser();
$total_secs = $array[0] * 10;
$hours = intdiv($total_secs, 3600);
$mins = intdiv(($total_secs % 3600), 60);
$secs = $total_secs % 60;
header("Content-Type: application/json");
echo '{"w": '.$array[0].', "d": '.$array[1].', "ETA": "'.$hours.' hours, '.$mins.' minutes, '.$secs.' seconds"}';
?>