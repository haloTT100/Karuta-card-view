<?php
include "database.php";
$conn = new kapcsolat();

if(isset($_POST["limit"], $_POST["start"]))
{
 
$result = $conn->getCards($_POST["start"], $_POST["limit"]);
 while($row = mysqli_fetch_array($result))
 {
    print('<div class="m-0 c col-6 col-lg-2">');
    print('<img src="'.$row['link'].'">');
    print('</div>');
 }
}
?>