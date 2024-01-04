<?php
include "database.php";
$conn = new kapcsolat();

if(isset($_POST["limit"], $_POST["start"]))
{
 
$result = $conn->getCards($_POST["start"],
 $_POST["limit"],
 $_POST["char_name"],
 $_POST["series"],
 $_POST["numberMin"],
 $_POST["numberMax"],
 $_POST["editionMin"],
 $_POST["editionMax"],
 $_POST["wishlistMin"],
 $_POST["wishlistMax"],
 $_POST["qualityMin"],
 $_POST["qualityMax"],
 $_POST["effortMin"],
 $_POST["effortMax"],
 $_POST["frame"],
 $_POST["numberOrder"],
 $_POST["editionOrder"],
 $_POST["wishlistOrder"],
 $_POST["qualityOrder"],
 $_POST["effortOrder"],
 $_POST["charNameOrder"],
 $_POST["seriesOrder"]);
 while($row = mysqli_fetch_array($result))
 {
   $code = "'".$row['code']."'";
    print('<div class="m-0 c col-6 col-lg-2">');
    print('<img onclick="copyCode('.$code.')" src="'.$row['link'].'">');
    print('</div>');
 }
}
?>